<?php

// Define the URL of the CSV file
$csvUrl = 'https://balonkov-party.cz/eshop_full_01_2024.csv';

// Read the CSV file into an array
$data = array_map('str_getcsv', file($csvUrl));

// Iterate over each row and construct the links
foreach ($data as &$row) {
    $productId = $row[0]; // Assuming the PRODUCT_ID is in the first column
    $link = "https://www.party-prodej.cz/katalog-obrazku/party-prodej/detail-717/$productId.jpg";
    $row[] = $link; // Add the link to the row
}

// Write the updated data to a new CSV file
$fp = fopen('updated_file.csv', 'w');
foreach ($data as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo "CSV file updated successfully.";

?>
