<?php
require 'includes/app.php';
includeTemplate('header');

use App\User;

$errors = User::getErrors();
$user = new User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($_POST['login']);
    $errors = $user->validate();

    if(empty($errors)) {
        $errors = $user->login();
    }
}

?>

<main class="login">
    <form method="POST">
        <?php foreach ($errors as $error) : ?>
            <div class="errors">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <fieldset>
            <label for="email">E-mail</label>
            <input type="e-mail" id="email" name="login[email]" value="<?php echo $user->email ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="login[password]">
        </fieldset>

        <input type="submit" value="Enter">
        <p class="create-account-paragraph">Don't have an account, <a href="register.php">create one</a></p>
    </form>
</main>

<?php
includeTemplate('footer');
?>