<?php
session_start();
include('config.php');

// $currentPage = $_SERVER['REQUEST_URI'];
// $unloggedPages = array('/profile.php', '/posting.php', '/account-settings.php', '/change-email.php', '/change-email.php', '/change-password.php', '/delete-account.php', '/change-partner.php');
// $loggedPages = array('/login.php', '/register.php');

// $_SESSION['ERROR'] = 1;

// foreach ($loggedPages as $site) {
//     if (isset($_SESSION['login_user']) && $currentPage == $site) {
//         $_SESSION['logMsg'] = 'You are already logged in! Redirecting...';
//         $_SESSION['url'] = 'index.php';
//         header("refresh:0;url=redirect.php");
//         break;
//     }
// }

// foreach ($unloggedPages as $site) {
//     if (!isset($_SESSION['login_user']) && $currentPage == $site) {
//         $_SESSION['logMsg'] = 'You must log in! Redirecting...';
//         $_SESSION['url'] = 'login.php';
//         header("refresh:0;url=redirect.php");
//         break;
//     }
// }

?>
