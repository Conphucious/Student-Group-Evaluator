<?php
include('session.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach($_POST as $projId => $content) { // Most people refer to $key => $value
        //echo "The HTML name: $name <br>";
        //echo "The content of it: $content <br>";
    }


    //echo $projId;
    header('Location: evaluate.php?id=' . $projId);
}

$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT course.code, course.name AS c_name, project.name AS p_name, project.id AS id
FROM student_group
JOIN project ON project.id = student_group.project_id
JOIN project_list ON project_list.project_id = project.id
JOIN course ON project_list.course_id = course.id
WHERE student_group.student_id = '$lakerid'");

$p = '';


while ($dat = $tableData -> fetch_array()) {

    $pid = $dat['id'];
    $tableCounter = $db -> query("SELECT COUNT(user_id) FROM enrollment WHERE course_id = '$pid'");

    $row = mysqli_fetch_array($tableCounter);
    //echo ($row[0] + 1) . "_";

    $p = $p . '<form method="post"><tr>
    <td>' . $dat['code'] . ' - ' . $dat['c_name'] . '</td>
    <td>' . $dat['p_name'] . '</td>';


    //disabled=true if already completed it

    if ($row[0] == 0) {

        $tableCounters = $db -> query("SELECT COUNT(eval_id)
FROM student_evaluation
JOIN evaluation ON eval_id = evaluation.id
WHERE evaluation.sender_id = '$lakerid';");

        $rowers = mysqli_fetch_array($tableCounters);

        if ($rowers[0] > 0) {
            $p = $p . '<td><input type="submit" value="Evaluate" name="' . $dat['id'] . '" disabled="true"></td>' . '</tr></form>';
        } else {
            $p = $p . '<td><input type="submit" value="Evaluate" name="' . $dat['id'] . '"></td>' . '</tr></form>';
        }
    } else {
        $p = $p . "<td>ONLY YOU IN HERE</td>" . '</tr></form>';
    }


    // ON POST, GIVE PROJECT.ID TO FORM
}


$argv[0]; // the script name
$argv[1]; // the first parameter
$argv[2]; // the second parameter

?>

<?php
if ($_GET) {
    $argument1 = $_GET['argument1'];
    $argument2 = $_GET['argument2'];
} else {
    $argument1 = $argv[1];
    $argument2 = $argv[2];
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
                        <h1 class="mt-4">Group Evaluation</h1>
                        <p>
                            <br>
                            <table cellpadding="15" style="border: 1px solid black; text-align:center;">
                                <tr>
                                    <th>COURSE</th>
                                    <th>PROJECT</th>
                                    <th></th>
                                </tr>

                                <?php echo $p; ?>
                            </table>
                        </p>
                    </div>
                </center>

            </div>
        </div>
        </script>
    </body>
</html>


