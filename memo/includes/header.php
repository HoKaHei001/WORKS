<?php

if (session_status() === PHP_SESSION_DISABLED) {
    session_start();
}

?>
<header>
    <h1>ひとことメモ</h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="/memo/public/user/logout.php" class="hyl">
            <div class="btn login_out">
                ログアウト
            </div>
        </a>
    <?php endif ?>
</header>
