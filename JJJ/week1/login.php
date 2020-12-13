<?php
require_once "pdo.php";
session_start();

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
 * Login Function
 *
 * @return header index | login
 */
if (isset($_POST['email']) && isset($_POST['pass'])) {

  /// Logout Current User
  unset($_SESSION['name']);
  unset($_SESSION['user']);

  /// Sanitization
  $ac = test_input($_POST['email']);
  $pw = test_input($_POST['pass']);

  /// Check if Input Fields empty show a message
  if (!empty($ac) && !empty($pw)) {

    /// If Email pattern don't match show error
    if (preg_match($emailPattern, $ac) == 1) {


      $selectquery = "SELECT user_id, name, password FROM users WHERE email = :em";
      $prepare = $pdo->prepare($selectquery);
      $execute = $prepare->execute(array(
        ':em' => $ac,
      ));

      if ($execute != FALSE) {

        $data = $prepare->fetch();
        $salt = 'XyZzy12*_';
        $password = hash('md5', $salt . $pw);
        echo $data['password'] . "<br>";
        echo $password;
        if ($password == $data['password']) {

          $_SESSION['name'] = $data['name'];
          $_SESSION['user'] = $data['user_id'];
          $_SESSION['success'] = "LOG In Succcess";
          header("Location: index.php");
          return;

        } else {

          $_SESSION['error'] = "Incorrect password";
        }
      } else {

        $_SESSION['error'] = "Incorrect User";
      }
    } else {

      $_SESSION['error'] = "Email must have an at-sign (@)";
    }
  } else {
    $_SESSION['error'] = "Email and Password are Required";
  }
  error_log("Login fail " . $_POST['email'] . " $pw");
  header("Location: login.php");
  return;
}

/// Check if any Error msg is set and then unset
if (isset($_SESSION['error'])) {
  $msg = '<div class="alert alert-warning" role="alert">
  <strong>' . $_SESSION['error'] . '</strong>
</div>';
  unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>MD Shahin Mia Robin's Login Page</title>
  <!-- bootstrap.php - this is HTML -->

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

</head>

<body>
  <div class="container text-center" style="padding : 100px;">
    <h1 class="bg-info text-white text-center">Please Log In</h1>
     <!-- Flash Message -->
     <span><?= empty($msg) ? '' : $msg ?></span>
    <form method="POST" action="login.php">
      <!-- Email -->
      <div class="row">
        <label class="col-md-3" for="email">Email
          <span class="text-danger"> *</span></label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="email" id="email"><br />
        </div>
      </div>
      <!-- password -->
      <div class="row">
        <label class="col-md-3" for="id_1723">Password
          <span class="text-danger"> *</span></label>
        <div class="col-md-6">
          <input class="form-control" type="password" name="pass" id="id_1723"><br />
        </div>
      </div>
      <div class="row-12">
        <input class="btn btn-success float-left" type="submit" onclick="return doValidate();" value="Log In">
        <a class="btn btn-warning" href="index.php" role="button">Cancel</a></div>
    </form>
    <p>
      For a password hint, view source and find an account and password hint
      in the HTML comments.
      <!-- Hint: 
                The account is umsi@umich.edu
                The password is the three character name of the 
                programming language used in this class (all lower case) 
                followed by 123. -->
    </p>
  </div>
</body>
<script>
  function doValidate() {
    console.log('Validating...');
    try {
      addr = document.getElementById('email').value;
      pw = document.getElementById('id_1723').value;
      console.log("Validating addr=" + addr + " pw=" + pw);
      if (addr == null || addr == "" || pw == null || pw == "") {
        alert("Both fields must be filled out");
        return false;
      }
      if (addr.indexOf('@') == -1) {
        alert("Invalid email address");
        return false;
      }
      return true;
    } catch (e) {
      return false;
    }
    return false;
  }
</script>

</html>