<?php
// Get the data from the URL query string (if present)
$computerName = isset($_GET['computerName']) ? $_GET['computerName'] : 'Unknown';
$osInfo = isset($_GET['osInfo']) ? $_GET['osInfo'] : 'Unknown';
$ramInfo = isset($_GET['ramInfo']) ? $_GET['ramInfo'] : 'Unknown';
$computerBrandModel = isset($_GET['computerBrandModel']) ? $_GET['computerBrandModel'] : 'Unknown';
$motherboardInfo = isset($_GET['motherboardInfo']) ? $_GET['motherboardInfo'] : 'Unknown';
$hardDriveInfo = isset($_GET['hardDriveInfo']) ? $_GET['hardDriveInfo'] : 'Unknown';
$isDomain = isset($_GET['isDomain']) ? $_GET['isDomain'] : 'Unknown';
$category = isset($_GET['category']) ? $_GET['category'] : 'Unknown';
$brand = isset($_GET['brand']) ? $_GET['brand'] : 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>TechAsset Log</title>
</head>
<body class="">

    <!--NavBar-->
    <nav class="navbar bg-white shadow fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">
            <img src="Images/TALogo.jpg" alt="" width= "180px" height="100px">
            <span class="fw-bold text-secondary fs-3">TechAsset Log</span>
          </a>
        </div>
      </nav>
    <!--NavBar-->
    
    <main>
        <section class="container-fluid main-container">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-sm-6 d-flex flex-column">
                        <h3 class="fw-bold text-secondary-emphasis">Upload Text File</h3>
                        <span class="mb-4">Please upload the text file to continue</span>

                        <form action="generate.php" method="POST" enctype="multipart/form-data">
                            <label for="systemInfoFile" class="form-label text-secondary">System Information text file</label>
                            <input class="form-control shadow-sm mb-3" type="file" id="systemInfoFile" name="systemInfoFile">
    
                            <label for="appsInfoFile" class="form-label text-secondary">Installed apps text file</label>
                            <input class="form-control shadow-sm mb-4" type="file" id="appsInfoFile" name="appsInfoFile">

                            <button class="btn btn-primary mb-3" style="width: 200px;">Load Files</button>
                        </form>
                    </div>
                </div>     
                <hr>
                <div class="row">
                    <h3 class="fw-bold text-secondary-emphasis mt-3">System Information</h3>
                    <span class="mb-4">Below are the following information of your PC</span>

                    <div class="p-5 shadow-sm rounded border mb-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th class="text-secondary-emphasis" scope="col">Category</th>
                                <th class="text-secondary-emphasis" scope="col">Information</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>PC Name</td>
                                <td><?php echo trim($computerName); ?></td>
                              </tr>
                              <tr>
                                <td>CPU Serial Number</td>
                                <td><?php echo trim($motherboardInfo); ?></td>
                              </tr>
                              <tr>
                                <td>Brand/Model</td>
                                <td><?php echo trim($brand); ?></td>
                              </tr>
                              <tr>
                                <td>Storage Type</td>
                                <td><?php echo trim($hardDriveInfo); ?></td>
                              </tr>
                              <tr>
                                <td>Ram Installed</td>
                                <td><?php echo trim($ramInfo); ?></td>
                              </tr>
                              <tr>
                                <td>Operating System</td>
                                <td><?php echo trim($osInfo); ?></td>
                              </tr>
                              <tr>
                                <td>Domain Connected</td>
                                <td><?php echo trim($isDomain); ?></td>
                              </tr>
                              <tr>
                                <td>Type</td>
                                <td><?php echo trim($category); ?></td>
                              </tr>
                              <tr>
                                <td>Condition</td>
                                <td>Working</td>
                              </tr>
                              <tr>
                                <td>Status</td>
                                <td>Assigned</td>
                              </tr>
                              <tr>
                                <td>Warranty Status</td>
                                <td><select class="form-select" aria-label="Default select example">
                                    <option disabled selected>Open this select menu</option>
                                    <option value="In Warranty">In Warranty</option>
                                    <option value="Out of Warranty">Out of Warranty</option>
                                  </select></td>
                              </tr>
                              <tr>
                                <td>Warranty Start Date</td>
                                <td><input type="text" class="txt-employee1 form-control" id="startDate" name="startDate" placeholder="dd/MM/yyyy"></td>
                              </tr>
                              <tr>
                                <td>Warranty End Date</td>
                                <td><input type="text" class="form-control" id="endDate" name="endDate" placeholder="dd/MM/yyyy"></textarea></td>
                              </tr>
                              <tr>
                                <td>Remarks</td>
                                <td><textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea></td>
                              </tr>
                            </tbody>
                          </table>
                    </div>                    
                </div>

                <div class="row">
                    <h3 class="fw-bold text-secondary-emphasis mt-3">Application Installed</h3>
                    <span class="mb-4">Below are the following applications installed in your pc</span>

                    <div class="p-5 shadow-sm rounded border mb-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th class="text-secondary-emphasis" scope="col">Application</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php
                                    // Check if we have installed applications data in the query string
                                    // Check if we have installed applications data in the query string
                                  if (isset($_GET['installedApps'])) {
                                    // Decode the JSON-encoded string into an array
                                    $installedApps = json_decode($_GET['installedApps'], true);

                                    // Loop through the installed applications and display each one in a table row
                                    if (count($installedApps) > 0) {
                                        foreach ($installedApps as $app) {
                                          echo '<tr><td>' . htmlspecialchars($app) . '</td></tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="1">No applications found.</td></tr>';
                                    }
                                  } else {
                                    echo '<tr><td colspan="1">No applications found.</td></tr>';
                                  }
                              ?>
                              </tr>                        
                            </tbody>
                          </table>
                    </div>                   
                </div> 
                
                <div class="row">
                    <div class="col-sm-6 d-flex flex-column">
                        <h3 class="fw-bold text-secondary-emphasis">Import to Database</h3>
                        <span class="mb-4">Please enter the following details to import</span>

                        <form action="">
                            <label for="employeeID" class="form-label">Employee ID</label>
                            <input type="text" class="form-control mb-4 p-3 shadow-sm" id="employeeID" placeholder="Ex. SP-0001" required>

                            <label for="location" class="form-label">Location</label>
                            <select class="form-select mb-4 p-3 shadow-sm" aria-label="Default select example" id="location" required>
                                <option disabled selected>Please select</option>
                                <option value="HQ">HQ</option>
                                <option value="Site">Site</option>
                              </select>

                            <label for="officeproject" class="form-label">Office/Project</label>
                            <input type="text" class="form-control mb-4 p-3 shadow-sm" id="officeproject" required>

                            <button class="btn btn-primary mb-5 shadow-sm" style="width: 200px;">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>