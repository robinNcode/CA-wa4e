<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    die("Not logged in.");
}

if (!isset($_GET['id'])) {

    $_SESSION['error'] = "Missing user id";
    header("Location: index.php");
    return;
}

$selectQuery = "SELECT profile_id, first_name FROM profile WHERE profile_id = :xyz && user_id = :uid";
$prepare = $pdo->prepare($selectQuery);

$execute = $prepare->execute(array(
    ":xyz" => $_GET['id'],
    ":uid" => $_SESSION['user'],
));

if ($execute === FALSE) {

    $_SESSION['error'] = "Bad Value For Profiles Id";
    header("Location: index.php");
    return;
} else {

    $data = $prepare->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['delete']) && isset($_POST['id'])) {

    $deleteSql = "DELETE FROM profile where profile_id = :pid && user_id = :uid";
    $prepare = $pdo->prepare($deleteSql);

    $execute = $prepare->execute(array(
        ':pid' => $_POST['id'],
        ':uid' => $_SESSION['user'],
    ));

    if ($delete === FALSE) {

        $_SESSION['error'] = "Failed to  Delete Record";
        header("Location: index.php");
        return;
    } else {

        $_SESSION['success'] = " Record deleted";
        header("Location: index.php");
        return;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>MD Shahin Mia Robin - DELETE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Confirm: Deleting : <?= htmlentities($data['first_name']) ?></h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $data['profile_id'] ?>">
            <button class="btn btn-danger" type="submit" name="delete">Delete</button>
        </form>
        <a class="btn btn-primary" href="index.php" role="button">Cancel</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>