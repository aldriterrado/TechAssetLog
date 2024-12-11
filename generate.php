<?php

// Check if the form is submitted and files are uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['systemInfoFile']) && isset($_FILES['appsInfoFile'])) {
    // Define the file paths
    $systemInfoFile = $_FILES['systemInfoFile'];
    $appsInfoFile = $_FILES['appsInfoFile'];

    // Initialize the data arrays
    $systemInfoData = [];
    $installedAppsData = [];

    // Check if the system information file was uploaded successfully
    if ($systemInfoFile['error'] == UPLOAD_ERR_OK) {
        // Read the system information file
        $systemInfoContent = file_get_contents($systemInfoFile['tmp_name']);
        
        // Parse the system information content (assuming it's URL-encoded and in query-string format)
        $systemInfoData = parseSystemInfo($systemInfoContent);
    } else {
        echo "Error uploading system information file.";
        exit;
    }

    // Check if the apps information file was uploaded successfully
    if ($appsInfoFile['error'] == UPLOAD_ERR_OK) {
        // Read the installed apps file
        $appsContent = file_get_contents($appsInfoFile['tmp_name']);
        
        // Parse the installed apps content
        $installedAppsData = parseInstalledApps($appsContent);
    } else {
        echo "Error uploading apps information file.";
        exit;
    }

    $data = array_merge($systemInfoData, ['installedApps' => $installedAppsData]);

    // **JSON encode** the 'installedApps' before adding to the query string
    $data['installedApps'] = json_encode($installedAppsData);
    
    // Prepare the query string to pass back to index.php
    $queryString = http_build_query($data); // Convert array to query string
    
    // Redirect back to index.php with the parsed data
    header("Location: computer.php?" . $queryString);
    exit;
} else {
    echo "No files uploaded.";
    exit;
}

// Function to parse system information content (URL-encoded query string)
function parseSystemInfo($content) {
    // Decode the URL-encoded content
    $content = urldecode($content);
    
    // Initialize an empty array to hold parsed data
    $data = [];
    
    // Split the content by '&' to get individual key-value pairs
    $pairs = explode('&', $content);

    // Loop through each pair and extract key-value pairs
    foreach ($pairs as $pair) {
        // Split each pair by '=' to get the key and value
        if (strpos($pair, '=') !== false) {
            list($key, $value) = explode('=', $pair, 2);
            $data[$key] = $value; // Store in array
        }
    }
    
    return $data;
}

// Function to parse the installed apps file (each app is on a new line)
function parseInstalledApps($content) {
    // Split the content into an array by new lines
    $installedApps = explode("\n", $content);

    // Remove any empty values (e.g., extra line breaks)
    $installedApps = array_filter($installedApps, function($app) {
        return !empty(trim($app));
    });

    // Reindex the array after filtering
    return array_values($installedApps);
}