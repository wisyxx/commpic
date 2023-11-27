<?php
require 'includes/app.php';
includeTemplate('header');
?>

<main class="login">
    <form method="POST">
        <label for="email">E-mail</label>
        <input type="e-mail" id="email" name="email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </form>
</main>

<?php
includeTemplate('footer');
?>