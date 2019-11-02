<?php
include('session.php');

$lakerid = $_SESSION['login_id'];
$tableData = $db -> query("SELECT course.code, course.name AS c_name, project.name AS p_name
FROM enrollment
JOIN course ON enrollment.course_id = course.id
JOIN project_list ON project_list.course_id = course.id
JOIN project ON project_list.project_id = project.id
WHERE enrollment.user_id = '$lakerid' ORDER BY course.code asc");

$p = '<table cellpadding="15" style="width: 80%; border: 1px solid black; text-align:center; ">
                  <tr>
                      <th>CLASS</th>
                      <th>PROJECT</th>
                  </tr>';
while ($dat = $tableData -> fetch_array()) {
    $p = $p . ' <tr>
                      <td>' . $dat[code] . ' - ' . $dat[c_name]  .'</td>
                      <td>' . $dat[p_name] . '</td>
                  </tr>';
}

$p = $p . ' </table>';

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

                <div class="container-fluid" id="dashboard">
                    <center>
                        <h1 class="mt-4">Dashboard Projects</h1><br>
                        Hello <i><?php echo $row['name']; ?></i>.<br><code>Here are your projects from your enrolled courses.</code><br><br>
                        <?php echo $p; ?>
                        <br><br><br>

                    </center>
                </div>


            </div>
        </div>
        </script>
    </body>
</html>
