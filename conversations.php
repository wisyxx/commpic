<?php
require 'includes/app.php';

session_start();

if (!isset($_SESSION['user-name'])) {
    header('Location: /login.php');
}

includeTemplate('header');
?>


<header>
    <nav class="navigation">
        <h1 class="navigation__mesaje">Welcome <?php echo $_SESSION['user-name']; ?>!</h1>
        <?php includeTemplate('user-menu') ?>
    </nav>
</header>



<?php
includeTemplate('footer');
?>