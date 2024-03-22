import os
import json
import csv
from json.decoder import JSONDecodeError
from tqdm import tqdm             # progress bars
from datetime import datetime, timedelta
import yfinance as yf

# Function to process a single JSON file
def process_json_file(file_path):
    with open(file_path, 'r') as json_file:
        try:
            data = json.load(json_file)
        except JSONDecodeError:
            return f"Error decoding JSON in file: {file_path}", None
    
    # Extract required data
    symbol = data['symbol']
    if symbol == 'NONE' or symbol == '': return 'symbol not found', None
    endDate = data['endDate']
    quarter = data['quarter']
    net_income = None
    stockholders_equity = None
    assets = None
    net_sales = None
    ROE = None
    Percent_Growth = None

    # Net Income
    for item in data['data']['ic']:
        if item['concept'] == 'ProfitLoss':
            net_income = item['value']
            break
        elif item['concept'] == 'NetIncomeLoss':
            net_income = item['value']
            break
    if net_income == 'N/A' or net_income == '': net_income = 0
    # Stockholders' Equity
    for item in data['data']['bs']:
        if item['concept'] == 'StockholdersEquity':
            stockholders_equity = item['value']
            break
        elif item['concept'] == 'StockholdersEquityIncludingPortionAttributableToNoncontrollingInterest':
            stockholders_equity = item['value']
            break     
    if stockholders_equity == 'N/A' or stockholders_equity == 0 or stockholders_equity == '':
        return 'stockholders_equity not found', None
    # Total Assets
    for item in data['data']['bs']:
        if item['concept'] == 'Assets':
            assets = item['value']
            break     
    if assets == 'N/A' or assets == '': assets = 0
    # Net Sales
    for item in data['data']['ic']:
        if item['concept'] == 'SalesRevenueNet':
            net_sales = item['value']
            break     
        elif item['concept'] == 'SalesRevenueGoodsNet':
            net_sales = item['value']
            break     
        elif item['label'] == 'Net sales':
            net_sales = item['value']
            break         
        elif item['label'] == 'Sales':
            net_sales = item['value']
            break         
        elif item['label'] == 'Revenue':
            net_sales = item['value']
            break              
        elif item['concept'] == 'SalesRevenueServicesNet':
            net_sales = item['value']
            break    
        elif item['concept'] == 'Revenues':
            net_sales = item['value']
            break     
        elif item['concept'] == 'InterestAndDividendIncomeOperating':
            net_sales = item['value']
            break             
        elif item['concept'] == 'ContractsRevenue':
            net_sales = item['value']
            break         
        elif item['concept'] == 'OilAndGasRevenue':
            net_sales = item['value']
            break      
        elif 'TotalRevenuesAndOtherIncome' in item['concept']:
            net_sales = item['value']
            break                       
        elif item['concept'] == 'FinancialServicesRevenue':
            net_sales = item['value']
            break   
        elif item['concept'] == 'RevenueFromContractWithCustomerExcludingAssessedTax':
            net_sales = item['value']
            break
    if net_sales == 'N/A' or net_sales == '': net_sales = 0         
    # ROE  
    if net_income is not None and stockholders_equity is not None:
        ROE = int(net_income) / int(stockholders_equity)
        if quarter != 'FY':
            ROE = ROE * 4

    if symbol is None or endDate is None or quarter is None or net_income is None or stockholders_equity is None or assets is None or net_sales is None or ROE is None:
        return 'Error', None
    # target label
    date_obj = datetime.strptime(endDate, '%Y-%m-%d')
    new_date_obj = date_obj + timedelta(days=365)  # Assuming a year has 365 days
    new_date_string = new_date_obj.strftime('%Y-%m-%d')
    stock_data = yf.download(symbol, start=date_obj, end=new_date_string, progress=False)
    if not stock_data.empty:
        first_close = stock_data.iloc[0]['Close']
        last_close = stock_data.iloc[-1]['Close']
        if first_close == 0: return 'YFinance Error', None
        Percent_Growth = ((last_close - first_close) / first_close) * 100
    else:
        return 'YFinance Error', None
    
    return 'Success', (symbol, endDate, quarter, net_income, stockholders_equity, assets, net_sales, ROE, Percent_Growth)

# Parent directory containing subfolders
parent_dir = 'data/'

# Output directory for CSV files
output_dir = 'clean_data/'

# Iterate through each subfolder
subdirectories = [name for name in os.listdir(parent_dir) if os.path.isdir(os.path.join(parent_dir, name))]
bar = tqdm(total = len(subdirectories) + 1, desc = 'Generating')
for subdir, _, files in os.walk(parent_dir):

    bar2 = tqdm(total=len(files), desc='Processing', leave=False)
    
    # Generate CSV file name based on subfolder name
    csv_file_name = os.path.basename(subdir) + '.csv'
    csv_file_path = os.path.join(output_dir, csv_file_name)

    # List to store extracted data
    data_list = []

    # Process each JSON file in the subfolder
    for file_name in files:
        if file_name.endswith('.json'):
            file_path = os.path.join(subdir, file_name)
            status, result = process_json_file(file_path)
            if status == 'Success':
                symbol, endDate, quarter, net_income, stockholders_equity, assets, sales, ROE, Percent_Growth = result
                data_list.append([symbol, endDate, quarter, net_income, stockholders_equity, assets, sales, ROE, Percent_Growth])
            bar2.update(1)
    bar2.close()

    # Write to CSV file
    if data_list:
      with open(csv_file_path, 'w', newline='') as csv_file:
        writer = csv.writer(csv_file)
        writer.writerow(['Symbol', 'EndDate', 'Quarter', 'NetIncome', 'StockholdersEquity', 'TotalAssets', 'NetSales', 'ROE', 'Percent_Growth'])
        writer.writerows(data_list)
        # print(f"CSV file '{csv_file_name}' generated successfully.")
    bar.update(1)
bar.close()

