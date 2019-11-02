<?php

include('session.php');
$error = 'Please login to the platform using your LakerNet ID.';

// if (isset($_POST['studentid']))
//     echo '<body onLoad="document.login.studentpin.focus();">';
// else
//     echo '<body onLoad="document.login.studentid.focus();">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lakerid = mysqli_real_escape_string($db, $_POST['studentid']);
    $password = mysqli_real_escape_string($db, $_POST['studentpin']);
    $row = ($db -> query("SELECT password FROM user WHERE id = '$lakerid'")) -> fetch_array();


    if ($password == $row['password']) {
        $_SESSION['login_id'] = $lakerid;
        header("location: dashboard.php");
        #exit();
    } else
        $error = '<div style="color:#cc0000; margin-top:10px">Laker ID or password is invalid</div>';

    # HASHED PASSWORD
    /* if (password_verify($password, $row['pass'])) {
     *     $_SESSION['login_user'] = $row['username'];
     *     #header("location: index.php");
     * } else
     * $error = '<div style="color:#cc0000; margin-top:10px">Laker ID or password is invalid</div>'; */

    $db -> close();
}

?>

<html>
	  <head>
		    <title>Student Evaluation Login</title>
		    <link rel="stylesheet" href="stylesheet.css">
		</head>
			  <table width="100%" height="100%" cellpadding="4" cellspacing="0" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
				    <tr>
					      <td>&nbsp;</td>
					      <td width="500" align="center" valign="middle">


						        <fieldset style="font-weight:bold; background-color: white"><br>
								        <p align="center"><img src="images/logo.png" /></p>
								        <p align="center">
                            <?php echo $error; ?>
                        </p>

								        <form method="post">
									          <table width="80%" cellpadding="4" cellspacing="0" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
										            <tr>
											              <td width="35%" align="right">LakerNet ID:</td>
											              <td width="40%"><input name="studentid" type="text" value="<?php if (isset($_POST['studentid'])) echo $_POST['studentid']; ?>" /></td>
											              <td width="25%"></td>
										            </tr>
										            <tr>
											              <td align="right">Password:</td>
											              <td><input name="studentpin" type="password" /></td>
											              <td>&nbsp;</td>
										            </tr>
										            <tr>
                                    <td colspan="3" align="center"><input name="Submit" type="submit" value="Login" /></td>
										            </tr>
									          </table>
								        </form>

							      </fieldset>

							      <p align="center"><b><font color="red">NOTICE:</font></b> If you are having trouble logging in, please <a href="help.html" target="_blank">click here</a> for further assistance.</p>
							      <p align="center">&copy;<script type="text/javascript">var date = new Date();document.write(date.getFullYear());</script> Phuc Nguyen - Student Evaluation Self-Service v.1</p>
					      </td>
					      <td>&nbsp;</td>
				    </tr>
			  </table>
		</body>
</html>
