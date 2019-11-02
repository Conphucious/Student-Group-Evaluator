<?php
include('session.php');
$counter = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach($_POST as $projId => $content) {}
    //    header('Location: edit-class.php?id=' . $projId);
}

$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT * from course where instructor_id = '$lakerid'");

$p = '';

while ($dat = $tableData -> fetch_array()) {
    $cid = $dat['id'];
    $tableCounter = $db -> query("SELECT COUNT(user_id) FROM enrollment WHERE course_id = '$cid'");

    $count = count(mysqli_fetch_array($tableCounter));
    // BUG HERE. STAYS 2 for some reason.
    echo $count . '_';

    $urlid = "'student-management.php?id=" . $dat['id'] . "'";
    $url = 'onclick="window.location.href=' . $urlid . ';"';

    echo $url;

    $p = $p . '<form method="post"><tr>
    <td>' . $dat['id'] . '</td>
    <td>' . $dat['code'] . '</td>
    <td>' . $dat['section'] . '</td>
    <td>' . $dat['name'] . '</td>
    <td>' . $dat['description'] . '</td>
    <td>' . $count . '</td>
    <td><input type="button" value="edit" name="'. ++$counter .'" ' . $url . '></td></form></tr>';
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
                            <table cellpadding="15" style="border: 1px solid black; text-align:center;">
                                <tr>
                                    <th>ID</th>
                                    <th>CODE</th>
                                    <th>SECTION</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>STUDENTS</th>
                                    <th></th>
                                </tr>
                                <?php echo $p; ?>
                            </table>
                        </p>
                    </div>

                    <input type="button" name="add" value="Add new class" onclick="window.location.href = 'add-class.php';">

                </center>

            </div>
        </div>
        </script>
    </body>
</html>


