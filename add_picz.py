import pandas as pd

# Read the CSV file
df = pd.read_csv('https://balonkov-party.cz/shop_full_01_2024.csv')

# Add a new column with the constructed links
df['LINK'] = df['PRODUCT_ID'].apply(lambda x: f"https://www.party-prodej.cz/k
atalog-obrazku/party-prodej/detail-717/{x.lower()}.jpg")

# Write the updated DataFrame to a new CSV file
df.to_csv('eshop_full_with_picz_01_2024.csv', index=False)
