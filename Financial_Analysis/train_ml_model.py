import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import GradientBoostingRegressor
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
import os

# Read the data from the CSV file
data = pd.read_csv('bulk_data.csv')

data['NetIncome'] = pd.to_numeric(data['NetIncome'], errors='coerce')
data['NetSales'] = pd.to_numeric(data['NetSales'], errors='coerce')
data['StockholdersEquity'] = pd.to_numeric(data['StockholdersEquity'], errors='coerce')
data['TotalAssets'] = pd.to_numeric(data['TotalAssets'], errors='coerce')
data['ROE'] = pd.to_numeric(data['ROE'], errors='coerce')
data['Percent_Growth'] = pd.to_numeric(data['Percent_Growth'], errors='coerce')

data.dropna(inplace=True)
data.reset_index(drop=True, inplace=True)

features = ['NetIncome', 'StockholdersEquity', 'TotalAssets', 'NetSales', 'ROE']
labels = 'Percent_Growth'

# Shuffle the data
train_data, test_data = train_test_split(data, test_size=0.2, shuffle=True)
X_train, y_train = train_data[features], train_data[labels]
X_test, y_test = test_data[features], test_data[labels]

print('Training Stock Model : Gradient Boosting Regressor')
model = GradientBoostingRegressor(random_state=42)
model.fit(X_train, y_train)

print('Gradient Boosting Regressor Generated')

predictions = model.predict(X_test)

mse = mean_squared_error(y_test, predictions)
mae = mean_absolute_error(y_test, predictions)
r2 = r2_score(y_test, predictions)
print(f"Mean Squared Error: {mse}")
print(f"Mean Absolute Error: {mae}")
print(f"R-squared Score: {r2}")

predictions_df = pd.DataFrame(predictions, columns=['Predicted'])
test_entry_statistics = predictions_df.agg(['mean', 'median', 'std', 'min', 'max']).transpose()
test_entry_statistics.columns = ['Mean', 'Median', 'Std Dev', 'Min', 'Max']
print(test_entry_statistics)