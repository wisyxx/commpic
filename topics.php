<?php
require 'includes/app.php';

session_start();

if (!isset($_SESSION['user-name'])) {
    header('Location: /login.php');
}

includeTemplate('header');
?>

<header>
    <nav class="topics-nav">
        <h1>Welcome <?php echo $_SESSION['user-name']; ?>!</h1>
        <div class="actions">
            <img class="user-ppf" src="src/images/avatars/myppf.JPG" alt="User profile picture">
            <a href="log-out.php">Log out</a>
        </div>
    </nav>
</header>