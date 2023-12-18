<main class="login">
    <h1 class="login__title">Your conversation starts here</h1>
    <form class="form" method="POST">
        <?php foreach ($errors as $error) : ?>
            <div class="errors">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <fieldset>
            <label for="email">E-mail</label>
            <input class="input" type="e-mail" id="email" name="login[email]" value="<?php echo $user->email ?>">

            <label for="password">Password</label>
            <input class="input" type="password" id="password" name="login[password]">
        </fieldset>

        <input class="form__submit" type="submit" value="Enter">
        <p class="form__paragraph">Don't have an account, <a class="form__link" href="register.php">create one</a></p>
    </form>
</main>