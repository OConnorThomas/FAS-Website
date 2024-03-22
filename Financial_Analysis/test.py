import os, pickle, math, sys
import pandas as pd
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
from tqdm import tqdm             # progress bars
import pandas as pd
from sklearn.preprocessing import StandardScaler
from keras.models import Sequential
from keras.layers import Dense, Input
import yfinance as yf

# hyperparameters
number = '1'

# Read the data from the CSV file
data = pd.read_csv('bulk_data.csv')

data['NetIncome'] = pd.to_numeric(data['NetIncome'], errors='coerce')
data['NetSales'] = pd.to_numeric(data['NetSales'], errors='coerce')
data['StockholdersEquity'] = pd.to_numeric(data['StockholdersEquity'], errors='coerce')
data['TotalAssets'] = pd.to_numeric(data['TotalAssets'], errors='coerce')
data['ROE'] = pd.to_numeric(data['ROE'], errors='coerce')
data['Percent_Growth'] = pd.to_numeric(data['Percent_Growth'], errors='coerce')

# Extract features and labels
features = data[['NetIncome', 'StockholdersEquity', 'TotalAssets', 'NetSales', 'ROE']]
labels = data['Percent_Growth']

def generate_model(SM = '', TD = '', XD = '') : # takes 1 min per stock to process

    if (XD != '' and XD != 'perform_estimate'):
        data = yf.ticker(f'{XD}').balancesheet
        X_test = data[features]

        with open(f'data/{XD}_data.pkl', 'wb') as data_file:
            pickle.dump(X_test, data_file)

        return
    
    # else process the entirety
    print(f'You\'ve selected {number} for your file extension')
    print('Accesing Data')
    data = pd.read_csv('bulk_data.csv')

    # Train-test split
    train_data, test_data = train_test_split(data, test_size=0.2, shuffle=True)
    X_train, y_train = train_data[features], train_data[labels]
    X_test, y_test = test_data[features], test_data[labels]
    # Standardize the features
    scaler = StandardScaler()
    features_train_scaled = scaler.fit_transform(X_train)
    features_test_scaled = scaler.transform(X_test)

    if (SM != ''):
        # Define the neural network architecture
        print('Training Stock Model : Neural Network')
        model = Sequential()
        model.add(Input(shape=(5,)))              # Input layer with 5 features
        model.add(Dense(64, activation='relu'))   # First layer
        model.add(Dense(64, activation='relu'))   # Hidden layer
        model.add(Dense(1, activation='linear'))  # Output layer with 1 target

        # Compile the model
        model.compile(optimizer='adam', loss='mean_squared_error')

        # Train the model
        model.fit(features_train_scaled, y_train, epochs=50, batch_size=32, validation_split=0.2)

        with open(SM, 'wb') as model_file:
            pickle.dump(model, model_file)

        print(f'Neural Network {number} Generated')
        return
    
    if (TD != ''):

        print('Generating Test Data')

        with open(TD, 'wb') as data_file:
            pickle.dump(features_test_scaled, data_file)
            pickle.dump(y_test, data_file)

        print('Test Data Generated')
        return


def test_set(stock_model_path = 'models/stock_model.pkl', test_data_path = 'models/test_data.pkl') :

    with open(stock_model_path, 'rb') as model_file:
        model = pickle.load(model_file)

    with open(test_data_path, 'rb') as data_file:
        X_test = pickle.load(data_file)
        y_test = pickle.load(data_file)

    # Evaluate the model
    predictions = model.predict(X_test)

    # get results
    mse = mean_squared_error(y_test, predictions)
    mae = mean_absolute_error(y_test, predictions)
    r2 = r2_score(y_test, predictions)
    print(f"Mean Squared Error: {mse}")
    print(f"Mean Absolute Error: {mae}")
    print(f"R-squared Score: {r2}")

    # asking to predict on one future stock
    predictions_df = pd.DataFrame(predictions, columns=['Predicted'])
    test_entry_statistics = predictions_df.agg(['mean', 'median', 'std', 'min', 'max']).transpose()
    test_entry_statistics.columns = ['Mean', 'Median', 'Std Dev', 'Min', 'Max']
    print(test_entry_statistics)

    if not os.path.exists(os.path.join('models', f'{sys.argv[1]}_predictions.png')):
        fig, ax = plt.subplots(figsize=(12, 10))
        predictions_df.plot(ax=ax, style='o', label='Data Points')

        # Overlay summary statistics as vertical lines
        for stat, value in test_entry_statistics.iterrows():
            ax.axhline(y=value['Mean'], color='purple', linestyle='--', label=f'{stat} Mean')
            ax.axhline(y=value['Median'], color='g', linestyle='--', label=f'{stat} Median')
            ax.axhline(y=value['Mean']-value['Std Dev'], color='yellow', linestyle='--', label=f'{stat} Std Dev')
            ax.axhline(y=value['Mean']+value['Std Dev'], color='yellow', linestyle='--', label=f'{stat} Std Dev')
            ax.axhline(y=value['Min'], color='g', linestyle='--', label=f'{stat} Min')
            ax.axhline(y=value['Max'], color='g', linestyle='--', label=f'{stat} Max')
            ax.axhline(y=0, color='r', linestyle='solid')
        
        ax.fill_between(range(len(predictions)), 8, 15, color='green', alpha=0.2, label='Target Earnings')
        ax.fill_between(range(len(predictions)),
            test_entry_statistics['Mean']-test_entry_statistics['Std Dev'],
            test_entry_statistics['Mean']+test_entry_statistics['Std Dev'],
            color='yellow', alpha=0.1, label='50%% of Prediction')

        # Customize the plot
        plt.xlabel('Data Point Index')
        plt.ylabel('Predicted Value')
        plt.title('Predictions with Summary Statistics Overlay')
        plt.legend()
        plt.savefig(os.path.join('pic', f'{sys.argv[1]}_predictions.png'))

if __name__ == "__main__":

    # stock_model_path = f'models/stock_model30.pkl'
    # test_data_path = f'models/test_data30.pkl'
    stock_model_path = f'models/stock_model{number}.pkl'
    test_data_path = f'models/test_data{number}.pkl'
    stock_ticker = ''
    if len(sys.argv) == 2: stock_ticker = f'{sys.argv[1]}'

    if not os.path.exists(stock_model_path):
        generate_model(SM=stock_model_path)
    if not os.path.exists(test_data_path):
        generate_model(TD=test_data_path)
    if (stock_ticker != ''):
        if not os.path.exists(f'data/{stock_ticker}_data.pkl'):
            generate_model(XD=stock_ticker)
        test_data_path=(f'data/{stock_ticker}_data.pkl')
    test_set(stock_model_path, test_data_path)