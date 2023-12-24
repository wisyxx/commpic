<main class="messages">
    <a class="back-button" href="/conversations">Back</a>
    <?php foreach ($conversation as $chat) : ?>
        <section class="message">
            <div class="message__info">
                <div class="user">
                    <img class="user__ppf--message" src="build/images/avatars/myppf.JPG" alt="User profile image">
                    <p class="user__name"><?php echo $chat->author ?></p>
                    <?php if ($chat->author === $_SESSION['user-name']) : ?>
                        <p class="user__name--you">you</p>
                    <?php endif; ?>
                    <p class="message__info--date"><?php echo $chat->creationDate ?></p>
                </div>

                <div class="message__actions">
                    <?php if ($chat->author === $_SESSION['user-name']) : ?>
                        <a href="/delete-message?id=<?php echo $chat->id ?>" class="message__actions--delete">
                            <img src="build/images/icon-delete.svg" alt="Delete icon">
                        </a>
                        <div class="message__actions--edit">
                            <img src="build/images/icon-edit.svg" alt="Edit icon">
                        </div>
                    <?php else : ?>
                        <a href="/reply" class="message__actions--reply">
                            <img src="build/images/icon-reply.svg" alt="Reply icon">
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <p class="message__content">
                <?php echo $chat->message ?>
            </p>
        </section>
    <?php endforeach; ?>
</main>