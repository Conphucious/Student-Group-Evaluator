<?php
//include('session.php');

$lakerid = $_SESSION['login_id'];
$row = ($db -> query("SELECT * FROM user WHERE id = '$lakerid'")) -> fetch_array();

if ($row['user_group_id'] == 1) {
    $menu = '
<a href="enrolled.php" class="list-group-item list-group-item-action bg-light">Enrolled Classes</a>
<a href="assigned-group.php" class="list-group-item list-group-item-action bg-light">Assigned Group</a>
<a href="class-evaluation.php" class="list-group-item list-group-item-action bg-light">Group Evaluations</a>';
} else if ($row['user_group_id'] == 2) {
    #array_push($pages, "class-management.php", "student-management.php");
    $menu = '
<a href="class-management.php" class="list-group-item list-group-item-action bg-light" onclick="hide()">Class Management</a>
<a href="student-management.php" class="list-group-item list-group-item-action bg-light">Student Management</a>';
} else if ($row['user_group_id'] == 3) {
    #array_push($pages, "system-management.php", "user-management.php");
    $menu = '
<a href="#" class="list-group-item list-group-item-action bg-light">System Management</a>
<a href="#" class="list-group-item list-group-item-action bg-light" onclick="hide()">User Management</a>';
}

#print_r($pages)


?>

<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><center><font color="#013220"><b>OSWEGO<br><font size="1px">STATE UNIVERSITY OF NEW YORK</font></b></font></center></div>

    <div class="list-group list-group-flush">

        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <?php echo $menu; ?>
        <a href="account.php" class="list-group-item list-group-item-action bg-light">Account Information</a>
        <a href="logout.php" class="list-group-item list-group-item-action bg-light">Sign out</a>

    </div>
</div>
