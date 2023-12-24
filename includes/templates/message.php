<main class="messages">
    <a class="back-button" href="/conversations">Back</a>
    <?php foreach ($conversation as $chat) : ?>
        <section class="message">
            <div class="message__info">
                <div class="user">
                    <img class="user__ppf" src="build/images/avatars/myppf.JPG" alt="User profile image">
                    <p class="user__name"><?php echo $chat->author ?></p>
                    <p class="message__info--date"><?php echo $chat->creationDate ?></p>
                </div>

                <a href="/reply" class="reply-button">
                    <img src="build/images/icon-reply.svg" alt="Reply icon">
                </a>
            </div>
            <p>
                <?php echo $chat->message ?>
            </p>
        </section>
    <?php endforeach; ?>
</main>