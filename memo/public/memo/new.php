<?php

require_once '../../includes/login-check.php';
require_once '../../models/Memo.php';

if (isset($_POST['submit_button'])) {
    if (!empty($_POST['body'])) {
        $body = $_POST['body'];
        $user = $_SESSION['user'];
        Memo::create($body, $user->getId());

        header('Location: ./index.php');
        return;
    }
    echo "メモを入力してください！";
}

?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <?php include '../../includes/header.php' ?>
    <h2>メモ更新</h2>
    <form action="./new.php" method="post">
        <label>
            <p>メモ：</p>
            <p><input type="text" name="body"></p>
        </label>
        <input type="submit" name="submit_button" class="sub_btn">
    </form>
    <a href="./index.php" class="hyl">
        <div class="btn">一覧へ戻る</div>
    </a>
</body>

</html>
