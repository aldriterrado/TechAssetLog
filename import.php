<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $employee_id = $_POST['employeeID'];       // Employee ID
    $location = $_POST['location'];      // Location (HQ or Site)
    $project = $_POST['officeproject'];        // Office/Project
    $warrantyStatus = $_POST['warrantyStatus']; // Warranty status
    $startDate = $_POST['startDate'];    // Warranty start date
    $endDate = $_POST['endDate'];        // Warranty end date
    $condition = $_POST['condition']; 
    $status = $_POST['status']; 
    $remarks = $_POST['remarks']; 
    $statusAsset = "Active";
    $assetType = "Computers";

    $computerName = isset($_POST['computerName']) ? $_POST['computerName'] : (isset($_GET['computerName']) ? $_GET['computerName'] : 'Unknown');
    $osInfo = isset($_POST['osInfo']) ? $_POST['osInfo'] : (isset($_GET['osInfo']) ? $_GET['osInfo'] : 'Unknown');
    $ramInfo = isset($_POST['ramInfo']) ? $_POST['ramInfo'] : (isset($_GET['ramInfo']) ? $_GET['ramInfo'] : 'Unknown');
    $computerBrandModel = isset($_POST['computerBrandModel']) ? $_POST['computerBrandModel'] : (isset($_GET['computerBrandModel']) ? $_GET['computerBrandModel'] : 'Unknown');
    $motherboardInfo = isset($_POST['motherboardInfo']) ? $_POST['motherboardInfo'] : (isset($_GET['motherboardInfo']) ? $_GET['motherboardInfo'] : 'Unknown');
    $hardDriveInfo = isset($_POST['hardDriveInfo']) ? $_POST['hardDriveInfo'] : (isset($_GET['hardDriveInfo']) ? $_GET['hardDriveInfo'] : 'Unknown');
    $isDomain = isset($_POST['isDomain']) ? $_POST['isDomain'] : (isset($_GET['isDomain']) ? $_GET['isDomain'] : 'Unknown');
    $category = isset($_POST['category']) ? $_POST['category'] : (isset($_GET['category']) ? $_GET['category'] : 'Unknown');
    $model = isset($_POST['brand']) ? $_POST['brand'] : (isset($_GET['brand']) ? $_GET['brand'] : 'Unknown');

    $installedApps = isset($_POST['installedApps']) ? json_decode($_POST['installedApps'], true) : [];
    

    try {
        // SQL Server connection parameters
        $serverName = "SPWS008";  // Your SQL Server host
        $connectionOptions = array(
            "Database" => "dbIT", // Database name
            "Uid" => "sa",           // SQL Server username
            "PWD" => "P@ssword1122"            // SQL Server password
        );

        // Establish the connection using PDO
        $conn = new PDO("sqlsrv:server=$serverName;Database=" . $connectionOptions['Database'], 
                        $connectionOptions['Uid'], 
                        $connectionOptions['PWD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Step 1: Insert system information into `tbITAssets`
        $sql = "INSERT INTO tb_Assets
                (assetType, serialNumber, status, locationID, officeProject) 
                VALUES 
                (:assetType, :serialNumber, :status, :locationID, :officeProject)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the query
        $stmt->bindParam(':assetType', $assetType);
        $stmt->bindParam(':serialNumber', $motherboardInfo);
        $stmt->bindParam(':status', $statusAsset);
        $stmt->bindParam(':locationID', $location);
        $stmt->bindParam(':officeProject', $project);

        // Execute the query
        $stmt->execute();

        // Step 2: Get the ID of the last inserted system information record
        $systemInfoId = $conn->lastInsertId(); // This gets the ID of the inserted row in `tbITAssets`

        // Step 3: Insert computer details into `Computers` table
       $sqlComputers = "INSERT INTO tb_Computers (assetID, type, assignedName, brandModel, storageType, ramInstalled, isDomain, status, warrantyStatus, warrantyStartDate, warrantyEndDate, remarks, condition) VALUES (:assetID, :type, :assignedName, :brandModel, :storageType, :ramInstalled, :isDomain, :status, :warrantyStatus, :warrantyStartDate, :warrantyEndDate, :remarks, :condition)";

       $stmt = $conn->prepare($sqlComputers);
       $stmt->bindParam(':assetID', $systemInfoId);
       $stmt->bindParam(':type', $category);
       $stmt->bindParam(':assignedName', $computerName);
       $stmt->bindParam(':brandModel', $computerBrandModel);
       $stmt->bindParam(':storageType', $hardDriveInfo);
       $stmt->bindParam(':ramInstalled', $ramInfo);
       $stmt->bindParam(':isDomain', $isDomain);
       $stmt->bindParam(':status', $status);
       $stmt->bindParam(':warrantyStatus', $warrantyStatus);
       $stmt->bindParam(':warrantyStartDate', $startDate);
       $stmt->bindParam(':warrantyEndDate', $endDate);
       $stmt->bindParam(':remarks', $remarks);
       $stmt->bindParam(':condition', $condition);
       
       $stmt->execute();

        // If successful, display a success message and redirect
        header("Location: computer.php?status=success");
        exit; // Ensure the script ends here
        
    } catch (Exception $e) {
        // Handle any errors during the connection or query execution
        echo "Error: " . $e->getMessage();
    }
}
?>