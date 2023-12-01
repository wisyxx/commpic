<?php
require 'includes/app.php';
includeTemplate('header');

use App\User;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($_POST['login']);
}

?>

<main class="login">
    <form method="POST">
        <fieldset>
            <label for="email">E-mail</label>
            <input type="e-mail" id="email" name="login[email]" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="login[password]" required>
        </fieldset>

        <input type="submit" value="Enter">
        <p class="create-account-paragraph">Don't have an account, <a href="register.php">create one</a></p>
    </form>
</main>

<?php
includeTemplate('footer');
?>