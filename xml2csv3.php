<?php
// Function to download XML file
function downloadXML($url, $outputFile) {
    $ch = curl_init($url);
    $file = fopen($outputFile, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $file);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($file);
}

// Function to convert XML to CSV
function convertXMLtoCSV($xmlFile, $csvFile) {
    $xml = simplexml_load_file($xmlFile);
 
    if ($xml === false) {
        die('Error parsing XML file.');
    }
 
    $csv = fopen($csvFile, 'w');
 
    foreach ($xml->children() as $row) {
        $csvData = [];
        foreach ($row->children() as $element) {
            // Format the third column as "0.00"
            $csvData[] = str_replace(',', '.', (string) $element);
        }
        fputcsv($csv, $csvData);
    }
 
    fclose($csv);
}

// Function to trigger a link
function triggerLink($url) {
    // Use file_get_contents() to make an HTTP GET request
    $response = file_get_contents($url);

    // Alternatively, you can use curl to make an HTTP request
    /*
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    */

    // Handle the response as needed
    if ($response === false) {
        echo 'Error triggering link.';
    } else {
        echo ' ';
        echo 'Link spusten! eShop updatovan...';
        echo ' ';
    }
}

// Define the URLs and file paths
$xmlUrl = 'https://www.party-prodej.cz/xml/webparty.xml';
$xmlFile = 'downloaded2.xml';
$csvFile = 'converted2.csv';
$linkUrl = 'https://balonkov-party.cz/module/obsstocks/importCron?token=WDz2MrnZqewoL1obkKpyL61aZ';

// Download the XML file
downloadXML($xmlUrl, $xmlFile);

// Convert XML to CSV
convertXMLtoCSV($xmlFile, $csvFile);

echo 'XML soubor stahnut a konvertovan do CSV! Operace probehla v poradku...';

// Trigger the link
triggerLink($linkUrl);

?>
