<?php
include('session.php');
$lakerid = $_SESSION['login_id'];


$counter = 0;

if ($_GET) {
    $id = $_GET['id'];
    echo $id;

    $tableData = $db -> query("SELECT * FROM user JOIN enrollment ON user_id = user.id WHERE course_id = '$id'");

    while ($dat = $tableData -> fetch_array()) {
        $p = $p . ' <tr><td><img src="' . $dat['profile_image'] . '" width="125px" height="125px"> </td>' .
             '<td>' . $dat['name'] . '</td>' .
             '<td>' . $dat['email_address'] . '</td>' .
           '<td><input type="button" name="rmBtn' . ++$counter . '" value="remove"></td>' .
             '</tr>';
    }

} else {
    echo 'INVALID URL';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'added';

}

?>

<html>
    <head>
        <title>Student Evaluation Dashboard</title>
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
                        <h1 class="mt-4">Class Management</h1>
                        <p>
                            <br>
                            <form method="POST">
                                <table cellpadding="15" style="border: 1px solid black; text-align:center;">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                    <?php echo $p; ?>
                                </table>
                        </p>
                    </div>

                    <input type="submit" name="add" value="Add a Student">
                            </form>
                </center>

            </div>
        </div>
        </script>
    </body>
</html>


