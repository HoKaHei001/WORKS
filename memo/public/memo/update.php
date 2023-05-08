<?php

require_once '../../includes/login-check.php';
require_once '../../models/Memo.php';

if (isset($_POST['submit_button'])) {
    $id = $_POST['id'];
    $body = $_POST['body'];

    /** @var User $user */
    $user = $_SESSION['user'];
    Memo::update($id, $body, $user->getId());

    header('Location: ./index.php');
    return;
}

$id = $_GET['id'];
$memo = Memo::get($id);

?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <?php include '../../includes/header.php' ?>
    <h2>メモ更新</h2>
    <form action="./update.php" method="post">
        <label>
            <p>メモ：</p>
            <p><input type="text" name="body" value="<?php echo $memo->getBody() ?>"></p>
        </label>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" name="submit_button" class="sub_btn">
    </form>
    <a href="./index.php" class="hyl">
        <div class="btn">一覧へ戻る</div>
    </a>
</body>

</html>
