<?php

session_start();

// Redirect the browser to view.php
if (!isset($_SESSION['email'])) {
  $msg = '<h1 style="color:red;">Not logged in</h1>';
  die($msg);
}

//data insertion starts here ......
include 'dbConnectionPDO.php'; //DB connection

/**
 * Destroy session and Logout
 */
if (isset($_POST['logout'])) {
  header("Location: view.php");
  return;
}

/**
 * Sanitize Post Data
 * @param string $data
 * @return string
 */
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/**
 * Recive's Post Request, Check Validation, Add data.
 */
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {

  ///Sanitization
  $make = test_input($_POST['make']);
  $year = test_input($_POST['year']);
  $milage = test_input($_POST['mileage']);

  /// Check is numeric
  if (is_numeric($year) && is_numeric($milage)) {
    /// if $make is empty then return error msg
    if (!empty($make)) {

      /// Prepare Insert quere.
      $stmt = $connection->prepare('INSERT INTO autos
                (make, year, mileage) VALUES ( :mk, :yr, :mi)');

      /// Execute query
      $insert = $stmt->execute(array(
        ':mk' => $make,
        ':yr' => $year,
        ':mi' => $milage
      ));

      /// If Insertion Fail @return error
      if ($insert != false) {

        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
      } else {
        $_SESSION['error'] = "Record Inserted Failed";
      }
    } else {
      $_SESSION['error'] = "Make is required";
    }
  } else {
    $_SESSION['error'] = "Mileage and year must be numeric";
  }
  header("Location: add.php");
  return;
}

// Check if any Error msg is set and then unset
if (isset($_SESSION['error'])) {
  $msg = '<div class="alert alert-warning" role="alert">
          <strong>' . $_SESSION['error'] . '</strong>
      </div>';
  unset($_SESSION['error']);
}

/// Check if any Success msg is set and then unset
if (isset($_SESSION['success'])) {
  $msg = '<div class="alert alert-warning" role="alert">
          <strong>' . $_SESSION['success'] . '</strong>
      </div>';
  unset($_SESSION['success']);
}

?>

<?php
include 'header.php';
if (isset($_SESSION['email'])) {
  echo '<h2 class="bg-primary text-light text-center">Tracking Autos for ';
  echo htmlentities($_SESSION['email']);
  echo "</h2>\n";
}
?>
<span><?= empty($msg) ? '' : $msg ?></span>
<br>
<form method="post">
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
      <button class="btn btn-danger" type="submit" name="logout">Cancel</button>
      <button type="submit" name="submit" class="btn btn-success float-right">Add</button>
    </div>
  </div>
</form>

</div>

<?php include 'footer.php'; ?>