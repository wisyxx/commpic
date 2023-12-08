<?php
require 'includes/app.php';

session_start();

if (!isset($_SESSION['user-name'])) {
    header('Location: /login.php?err=0');
}

includeTemplate('header');
?>

<header>
    <h1>Welcome <?php echo $_SESSION['user-name']; ?>!</h1>
    <form method="POST">
        <input type="submit" value="Sign off">
    </form>
</header>