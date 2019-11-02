<?php
include('session.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Location: evaluate.php?id=' . $projId);
}

$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT * from user where id = '$lakerid'");
$dat = $tableData -> fetch_array();

?>

<html>
    <head>
        <title>Student Evaluation Account Settings</title>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/simple-sidebar.css" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <?php include('nav.php'); ?>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom"></nav>

                <center>
                    <div class="container-fluid" id="class_eval">
                        <h1 class="mt-4">Account Settings</h1>
                        <p>
                            <code><?php echo '<img src="' . $dat['profile_image'] . '" width="15%" height="20%">'; ?></code><br><br>
                            <b>Group</b>: <code><?php echo $dat['user_group_id']; ?></code><br>
                            <b>Name</b>: <code><?php echo $dat['name']; ?></code><br>
                            <b>Email</b>: <code><?php echo $dat['email_address']; ?></code><br>
                            <b>Registration Date</b>: <code><?php echo $dat['created_at']; ?></code>
                        </p>
                    </div>
                </center>

            </div>
        </div>
        </script>
    </body>
</html>


