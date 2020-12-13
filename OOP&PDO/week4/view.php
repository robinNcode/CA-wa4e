<?php
session_start();

// Redirect the browser to view.php
if (!isset($_SESSION['email'])) {
    $msg = '<h1 style="color:red;">Not logged in</h1>';
    die($msg);
} 
include 'dbConnectionPDO.php'; //DB connection

?>

<?php include 'header.php'; ?>

<div class="container pt-4">
    <?php

        if (isset($_SESSION['email'])) {
            echo '<h2 class="bg-primary text-light text-center">Tracking Autos for ';
            echo htmlentities($_SESSION['email']);
            echo "</h2>\n";
        }
    ?>
    
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
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) :
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
        <div class="card-footer">
            <a class="float-left" href="add.php">Add New</a>
            <a class="float-right" href="logout.php">Logout</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>