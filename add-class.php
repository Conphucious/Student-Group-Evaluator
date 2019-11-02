<?php
include('session.php');
$lakerid = $_SESSION['login_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $section = $_POST['section'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $tableData = $db -> query("INSERT INTO course (code, section, name, description, instructor_id) VALUES ('$code', '$section', '$name', '$desc', '$lakerid')");

    echo 'added';
    header("location: class-management.php");

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
                                    <th>CODE</th>
                                    <th>SECTION</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="code"> </td>
                                    <td><input type="text" name="section"> </td>
                                    <td><input type="text" name="name"> </td>
                                    <td><input type="text" name="description"> </td>
                                </tr>
                            </table>
                        </p>
                    </div>

                    <input type="submit" name="add" value="Add to class registry">
                                </form>
                </center>

            </div>
        </div>
        </script>
    </body>
</html>


