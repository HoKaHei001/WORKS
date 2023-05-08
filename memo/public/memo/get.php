<?php

require_once '../../includes/login-check.php';
require_once '../../models/Memo.php';
require_once '../../models/Comment.php';

if (isset($_POST['submit_button'])) {
    $comment = $_POST['comment'];
    $id = $_POST['memoId'];
    $user = $_SESSION['user'];
    Comment::create(
        $comment,
        $user->getId(),
        $id
    );
};

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$memo = Memo::get($id);
// $user = User::getById($memo->getUserId());

$comments = $memo->comments();

?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <?php include '../../includes/header.php' ?>
    <h2>メモ詳細</h2>
    <p>
        ID: <?php echo $memo->getId() ?>
    </p>
    <p>
        <?php echo $memo->getBody() ?>
    </p>
    <p>
        更新日時<?php echo $memo->getUpdatedAt() ?>
    </p>
    <p>
        投稿者　<?php echo $memo->user()->getName() ?>さん
    </p>

    <h2>コメント</h2>

    <form action="./get.php?<?php echo $id ?>" method="post">
        <input type="text" name="comment">
        <input type="hidden" name="memoId" value="<?php echo $id ?>">
        <input type="submit" name="submit_button" value="送信">
    </form>

    <ul>
        <?php foreach ($comments as $comment) : ?>
            <li>
                <?php echo $comment->getComment() ?>
                <?php echo $comment->user()->getName() ?>さん
            </li>
        <?php endforeach ?>
    </ul>

    <a href="./index.php" class="hyl">
        <div class="btn">一覧へ戻る</div>
    </a>
</body>

</html>
