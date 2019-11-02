<?php
include('session.php');
// ONE POTENTIAL ISSUE IS TWO USERS ON A THE SAME TIME.... WILL NOT REFLECT CHANGES UNLESS REFRESH.


$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT student_group.project_id, project.name AS p_name, project.description, course.name AS c_name, course.code
FROM user
JOIN student_group ON user.id = student_group.student_id
JOIN project ON student_group.project_id = project.id
JOIN project_list ON project.id = project_list.project_id
JOIN course ON project_list.course_id = course.id
WHERE user.id = '$lakerid' ORDER BY course.code asc");


$p = '';

while ($dat = $tableData -> fetch_array()) {
    $project_id = $dat['project_id'];
    $proj_description = $dat['description'];
    $project_name = $dat['p_name'];

    $class_code = $dat['code'];
    $course_name = $dat['c_name'];

    $p = $p . '<tr><h5>[' . $class_code . '] ' . $course_name . '</h5><br>
         <table style="width: 80%; border: 1px solid black; text-align:center;">
    <caption>' . $project_name . ' :: ' . $proj_description . '</caption>' . '
    <tr>
    <th></th>
    <th>STUDENT NAME</th>
    <th>EMAIL ADDRESS</th>
    </tr>';

    $pp = '';

    $tableDataInner = $db -> query("SELECT user.profile_image, user.name, user.email_address, user.id
     FROM user
     JOIN student_group ON student_group.project_id = '$project_id' AND student_group.student_id = user.id
     ORDER BY user.name asc;");

    while ($innerDat = $tableDataInner -> fetch_array()) {
        $pp = $pp . '<tr><td><img src="' . $innerDat['profile_image'] . '" width="75px" height="75px"></td>';

        if ($_SESSION['login_id'] != $innerDat['id']) {
            $pp = $pp . '<td>' . $innerDat['name']  . '</td>';
        } else {
            $pp = $pp . '<td><u>' . $innerDat['name']  . '</u></td>';
        }

        $pp = $pp . '<td>' . $innerDat['email_address'] . '</td>';
    }
    $p = $p . $pp . '</table></tr><br><br><br>';
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
                    <div class="container-fluid" id="assigned_group">
                        <h1 class="mt-4">Assigned Group</h1>
                        <p><br>
                            <?php echo $p ?>
                        </p>
                    </div>
                </center>


            </div>
        </div>
        </script>
    </body>
</html>
