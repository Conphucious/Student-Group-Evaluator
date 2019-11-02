<?php

include('session.php');

$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT course.id, code, section, course.name, description, user.name as instructor
FROM course
JOIN enrollment ON enrollment.course_id = course.id
JOIN user ON course.instructor_id = user.id
WHERE enrollment.user_id = '$lakerid' ORDER BY course.id");

$p = '';

while ($dat = $tableData -> fetch_array()) {

    $p = $p . "<tr> ";

    /* if (strpos($dat['code'], 'CSC') !== false) {
     *     $p = $p . '<td><img src="images/code_course.png" width="25px" height="25px"></td>';
     * } else {
     *     $p = $p . '<td><img src="images/course.png" width="25px" height="25px"></td>';
     * } */


    $p = $p . "<td>" . $dat['name'] . "</td>" . // have url here for course id which has full course information.
         "<td>" . $dat['code'] . "</td>" .
         "<td>" . $dat['section'] . "</td>" .
         "<td>" . $dat['description'] . "</td>" .
         "<td>" . $dat['instructor'] . "</td>" .
         "</tr>";

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
                    <div class="container-fluid" id="enrolled_classes">
                        <h1 class="mt-4">Enrolled Classes</h1>
                        <p>
                            <br>
                            <table cellpadding="15" style="border: 1px solid black; text-align:center;">
                                <tr>
                                    <!-- <th></th> -->
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>SECTION</th>
                                    <th>DESCRIPTION</th>
                                    <th>INSTRUCTOR</th>
                                </tr>
                                <?php echo $p ?>
                            </table>
                        </p>
                    </div>
                </center>
            </div>
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        </script>
    </body>
</html>
