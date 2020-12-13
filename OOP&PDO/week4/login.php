<?php
session_start();

if (!empty($_POST['cancel'])) {
    header("location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$storedHash = '1a52e17fa899cf40fb04cfc42e6352f1';
$failure = false;

if (isset($_POST['email']) && isset($_POST['pass'])) {

    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $_SESSION['error'] = "User name and password are required";
        header("Location: login.php");
        return;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else {
        $pass = $_POST['pass'];
        $check = hash('md5', $salt . $pass);

        if ($check == $storedHash) {
            // Redirect the browser to autos.php
            error_log("Log in success : " . $_POST['email']);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['success'] = "Log in successfull !!!";
            header("Location: view.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password";
            error_log("Log in Fail : " . $_POST['email'] . " $check ");
            header("Location: login.php");
            return;
        }
    }
}

?>

<!-- view starts here -->
<?php include 'header.php'; ?>

<div class="container pt-4">
    <div class="card ">
        <h2 class="card-head text-center bg-success text-white">LOG IN PANEL !</h2>
        <div class="card-body">
            <div class="container">
                <?php
                if (isset($_SESSION['error'])) {
                    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
                    unset($_SESSION['error']);
                }
                ?>
                <form method="POST">
                    <div class="form-group row pt-4">
                        <label for="inputName" class="col-md-4 col-form-label">User Name :</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" id="inputName" placeholder="User Name here">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName1" class="col-md-4 col-form-label">Password :</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="pass" id="inputName1" placeholder="Password here">

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-10">
                            <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-primary float-right">Log In</button>
                        </div>
                    </div>
                </form>
                <p>
                    ***For a password hint, view source and find a password hint
                    in the HTML comments.
                    <!-- Hint: The password is the four character sound a cat
                    makes (all lower case) followed by php123. -->
                </p>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>