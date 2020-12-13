<?php

// Demand a GET parameter
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if (isset($_POST['logout'])) {
    header('location: index.php');
    return;
}

//data insertion starts here ......
include 'dbConnectionPDO.php';//DB connection

//to avoid html injection
function test_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Validation for posted data
$validation = $dbMsg = "";
if (isset($_POST['submit']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {

    $make = test_input($_POST['make']);
    $year = test_input($_POST['year']);
    $mileage = test_input($_POST['mileage']);

    if (strlen($make) < 1 || strlen($year) < 1 || strlen($mileage) < 1) {
        $validation = "Make is required";
    } else if (!is_numeric($year) && !is_numeric($mileage)) {
        $validation = "Mileage and year must be numeric";
    }
    else{

        $stmt = $connection->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
            ':mk' => $make,
            ':yr' => $year,
            ':mi' => $mileage
        ));

        if($stmt == true)
            $dbMsg = '<div class="bg-success text-center text-light"> Record Inserted </div>';
        else $dbMsg = '<div class="bg-danger text-center text-light"> Insertion Failed </div>';
    }

    
}

?>

<?php include 'header.php'; ?>

<div class="container pt-4">
    <?php
    if (isset($_REQUEST['name'])) {
        echo '<h2 class="bg-primary text-light text-center">Tracking Autos for ';
        echo htmlentities($_REQUEST['name']);
        echo "</h2>\n";
    }
    ?>

    <!-- form starts here -->
    <form method="POST" class="border border-info">
        <?php
            if ($validation !== false) {
                // Look closely at the use of single and double quotes
                echo ('<div class="bg-danger text-white text-center">' . htmlentities($validation) . "</div>\n");
            }

            if(!empty($dbMsg)){
                echo $dbMsg;
            }
        ?>
        <div class="form-group row ml-4 pt-4">
            <label for="inputName" class="col-md-4 col-form-label">Make :</label>
            <span class="text-danger">*</span>
            <div class="col-md-6">
                <input type="text" class="form-control" name="make" id="inputName" placeholder="Auto Mobile Information">
            </div>
        </div>
        <div class="form-group row ml-4">
            <label for="inputName1" class="col-md-4 col-form-label">Year :</label>
            <span class="text-danger">*</span>
            <div class="col-md-6">
                <input type="text" class="form-control" name="year" id="inputName1" placeholder="Year here">
            </div>
        </div>
        <div class="form-group row ml-4">
            <label for="inputName2" class="col-md-4 col-form-label">Mileage :</label>
            <span class="text-danger">*</span>
            <div class="col-md-6">
                <input type="text" class="form-control" name="mileage" id="inputName2" placeholder="Mileage here">
            </div>
        </div>
        <div class="form-group row ml-4">
            <div class="col-10">
                <button class="btn btn-danger" type="submit" name="logout">Logout</button>
                <button type="submit" name="submit" class="btn btn-success float-right">Add</button>
            </div>
        </div>
    </form>

    <!-- Table stars here -->

    <div class="card pt-4">
        <div class="card-header">
            <h3 class="text-center bg-info text-light">Automobiles</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Year</th>
                        <th>Name</th>
                        <th>Mileage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $stmt = $connection->query("SELECT auto_id, year, make, mileage FROM autos ORDER BY auto_id");
                        while($data = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td><?= $data['auto_id'] ?></td>
                        <td><?= $data['year'] ?></td>
                        <td><?= $data['make'] ?></td>
                        <td><?= $data['mileage'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>

<?php include 'footer.php'; ?>