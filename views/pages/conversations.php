<header>
    <nav class="conversations-navigation">
        <h1 class="conversations-navigation__mesaje">Welcome <?php echo $_SESSION['user-name']; ?>!</h1>
        <?php includeTemplate('user-menu'); ?>
    </nav>
</header>

<main class="conversations">
    <?php foreach ($conversations as $conversation) : ?>
        <a href="/<?php $conversation->link ?>" class="conversation">
            <h1><?php echo $conversation->name ?></h1>
            <div class="conversation__data">
                <p class="conversation__author"><?php  ?></p>
                <div class="tags">

                </div>
            </div>
        </a>
    <?php endforeach; ?>
</main>