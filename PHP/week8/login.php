<?php

    
    if(!empty($_POST['cancel'])){
        header("location: index.php");
        return;
    }

    $salt = 'XyZzy12*_';
    $storedHash = '1a52e17fa899cf40fb04cfc42e6352f1';
    $failure = false;

    if(isset($_POST['who']) && isset($_POST['pass'])){
        
        if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
            $failure = "User name and password are required";
        } 
        else {
            $pass = $_POST['pass'];
            $check = hash('md5',$salt.$pass);

            if ( $check == $storedHash ) {
                // Redirect the browser to game.php
                header("location: game.php?name=".urlencode($_POST['who']));
                return;
            } 
            else {
                $failure = "Incorrect password";
            }
        }
    }

?>

<!-- view starts here -->
<?php include 'bootstrap.php'; ?>
<div class="container pt-4">
    <div class="card ">
        <h2 class="card-head text-center bg-success text-white">LOG IN PANEL !</h2>
        <div class="card-body">
            <div class="container">
            <?php
                if ( $failure !== false ) {
                    // Look closely at the use of single and double quotes
                    echo('<div class="bg-danger text-white">'.htmlentities($failure)."</div>\n");
                }
            ?>
                <form method="POST">
                    <div class="form-group row pt-4">
                        <label for="inputName" class="col-md-4 col-form-label">User Name :</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="who" id="inputName" placeholder="User Name here">
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