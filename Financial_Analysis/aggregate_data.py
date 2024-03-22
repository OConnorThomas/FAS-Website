import os
import csv

# Path to the parent directory containing CSV files
parent_directory = 'clean_data'

# Output file name for the master CSV file
output_file = 'bulk_data.csv'

# Function to get all CSV files in the directory
def get_csv_files(directory):
    csv_files = []
    for file in os.listdir(directory):
        if file.endswith('.csv'):
            csv_files.append(os.path.join(directory, file))
    return csv_files

# Function to write entries from all CSV files to the master file
def write_to_master_file(csv_files, output_file):
    lines = 0
    with open(output_file, 'w', newline='') as master_csv:
        writer = csv.writer(master_csv)
        for csv_file in csv_files:
            with open(csv_file, 'r') as csv_input:
                reader = csv.reader(csv_input)
                for row in reader:
                    writer.writerow(row)
                    lines = lines + 1
    return lines

# Get all CSV files in the directory
csv_files = get_csv_files(parent_directory)

# Write entries from all CSV files to the master file
entries = write_to_master_file(csv_files, output_file)

print(f"All entries have been written to {output_file} with {entries} entires")
