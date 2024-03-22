import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from keras.models import Sequential
from keras.layers import Dense, Dropout
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score

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

# Shuffle the data
features_train, features_test, labels_train, labels_test = train_test_split(features, labels, test_size=0.2, random_state=42)

# Standardize the features
scaler = StandardScaler()
features_train_scaled = scaler.fit_transform(features_train)
features_test_scaled = scaler.transform(features_test)

# Define the neural network architecture
model = Sequential([
  Dense(128, activation='relu'),
  Dense(128, activation='relu'),
  Dropout(0.5),
  Dense(64, activation='relu'),
  Dense(1, activation='linear')
])

# Compile the model
model.compile(optimizer='adam', loss='mean_squared_error', metrics=['accuracy'])

# Train the model
model.fit(features_train_scaled, labels_train, epochs=50, batch_size=1, validation_split=0.2)

predictions = model.predict(features_test_scaled)

mse = mean_squared_error(labels_test, predictions)
mae = mean_absolute_error(labels_test, predictions)
r2 = r2_score(labels_test, predictions)
print(f"Mean Squared Error: {mse}")
print(f"Mean Absolute Error: {mae}")
print(f"R-squared Score: {r2}")

predictions_df = pd.DataFrame(predictions, columns=['Predicted'])
test_entry_statistics = predictions_df.agg(['mean', 'median', 'std', 'min', 'max']).transpose()
test_entry_statistics.columns = ['Mean', 'Median', 'Std Dev', 'Min', 'Max']
print(test_entry_statistics)