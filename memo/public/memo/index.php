<?php

require_once '../../includes/login-check.php';
require_once '../../models/Memo.php';

$memos = Memo::getAll();

if (!isset($_COOKIE['userId'])) {
    header('Location: ../user/login.php');
    return;
}


if (isset($_POST['submit_button'])) {
    if (!empty($_POST['body'])) {
        $body = $_POST['body'];
        $memos = Memo::search($body);
    } else {
        echo '<h4 style="color:red">検索したい内容を入力してください！</h4>';
    }
}

if (isset($_POST['all_submit_button'])) {
    $memos = Memo::getAll();
}


?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <?php include '../../includes/header.php' ?>
    <h2>メモ一覧</h2>
    <a href="./new.php" class="hyl">
        <div class="btn">
            新規作成
        </div>
    </a>
    <!-- <form action="./index.php" method="post">
        <label>
            本文を探す
            <p><input type="text" name="body"></p>
        </label>
        <input type="submit" name="submit_button" value="検索" class="sub_btn">
        <input type="submit" name="all_submit_button" value="すべて" class="sub_btn">
    </form> -->

    <a href="./search.php">検索</a>

    <table>
        <tr class="memos_table">
            <th>ID</th>
            <th>本文</th>
            <th>更新日時</th>
            <th>詳細</th>
            <th>更新</th>
            <th>削除</th>
        </tr>
        <?php foreach ($memos as $memo) : ?>
            <tr class="memos">
                <td><?php echo $memo->getId() ?></td>
                <td class="memo_body"><?php echo $memo->getBody() ?></td>
                <td><?php echo $memo->getUpdatedAt() ?></td>
                <td><a href="./get.php?id=<?php echo $memo->getId() ?>">詳細</a></td>
                <td><a href="./update.php?id=<?php echo $memo->getId() ?>">更新</a></td>
                <td><a href="./delete.php?id=<?php echo $memo->getId() ?>">削除</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>
