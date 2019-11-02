<?php

include('session.php');

$counter = 0;

$lakerid = $_SESSION['login_id'];


$tableCounters = $db -> query("SELECT COUNT(eval_id)
FROM student_evaluation
JOIN evaluation ON eval_id = evaluation.id
WHERE evaluation.sender_id = '$lakerid';");

$rowers = mysqli_fetch_array($tableCounters);

if ($rowers[0] > 0) {
    echo $rowers[0];
    echo 'ALREADY RATED THIS GROUP';
    return;
}



// CHECK IF YOUR ONLY ONE IN GROUP. DON'T GET TO RATE YOURSELF.

if ($_GET) {
    $id = $_GET['id'];
    //echo $id;

    $tableData = $db -> query("SELECT student_group.project_id, project.name AS p_name, project.description, course.name AS c_name, course.code
FROM user
JOIN student_group ON user.id = student_group.student_id
JOIN project ON student_group.project_id = project.id
JOIN project_list ON project.id = project_list.project_id
JOIN course ON project_list.course_id = course.id
WHERE user.id = '$lakerid' AND project.id = '$id'");

    $p = '';

    while ($dat = $tableData -> fetch_array()) {

        $project_id = $dat['project_id'];
        $proj_description = $dat['description'];
        $project_name = $dat['p_name'];

        $class_code = $dat['code'];
        $course_name = $dat['c_name'];

        $p = $p . '<br>
         <table cellpadding="5px" style="border: 1px solid black; text-align:center;">
    <caption>' . $project_name . ' :: ' . $proj_description . '</caption>' . '
    <tr>
    <th></th>
    <th>STUDENT NAME</th>
    <th>SCORE</th>
    <th>COMMENTS</th>
    </tr>';

        $pp = '';

        $innerTableData = $db -> query("SELECT user.profile_image, user.name, user.id FROM user JOIN student_group ON student_group.project_id = '$project_id' AND student_group.student_id = user.id ORDER BY user.name asc;");

        while ($innerDat = $innerTableData -> fetch_array()) {


            if ($innerDat['id'] != $lakerid) {

                $pp = $pp . '<form method="post"><tr><td><img src="' . $innerDat['profile_image'] . '" width="75px" height="75px"></td>';

                if ($_SESSION['login_id'] != $innerDat['id']) {
                    $pp = $pp . '<td>' . $innerDat['name']  . '</td>';
                } else {
                    $pp = $pp . '<td><u>' . $innerDat['name']  . '</u></td>';
                }

                $pp = $pp . '<td>

<select name="rating' . $counter .'">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
<input type="hidden" name="ider' . $counter  .'"  value="' . $innerDat['id'] . '" hidden>
</td>';
                $pp = $pp . '<td><input type="text" name="comments' . $counter . '"></td>';
                $counter++;
            }

        }
        $p = $p . $pp . '</table></tr><input type="submit" value="submit rating"></form>';
        //$p = $p . 'Members: ' . $counter . '<br><br>';
    }

} else {
    echo "YOU CAN'T VISIT DIS SITE CUZ NOT PROPR REQUEST";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < $counter; $i++) {
        $comments = mysqli_real_escape_string($db, $_POST['comments' . $i]);
        if ($comments == "") {
            echo 'NO COMMENT WAS MADE';
            return;
        }
    }

    $arr = array();

    for ($i = 0; $i < $counter; $i++) {
        $comments = mysqli_real_escape_string($db, $_POST['comments' . $i]);
        $score = mysqli_real_escape_string($db, $_POST['rating' . $i]);

        $ids = mysqli_real_escape_string($db, $_POST['ider' . $i]);

        $db -> query("INSERT INTO evaluation (sender_id, recipient_id, points, comments) VALUES ('$lakerid', '$ids', '$score', '$comments')");


        $last_id = mysqli_insert_id($db);
        array_push($arr, $last_id);
    }

    for ($i = 0; $i < count($arr); $i++) {
        $db -> query("INSERT INTO student_evaluation (eval_id, project_id) VALUES ('$arr[$i]', '$id')");
    }
    header("location: class-evaluation.php");
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
                    <div class="container-fluid" id="eval">
                        <h1 class="mt-4">Group Project Evaluation</h1>
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
