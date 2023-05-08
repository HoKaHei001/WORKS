<?php

require_once __DIR__ . '/../../models/User.php';

session_start();

if (isset($_POST['submit_button'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        $result = $user->login();

        if ($result['isSucceeded']) {
            $_SESSION['user'] = $user;
            setcookie('userId', $user->getId(), time() + 60 * 60 * 24, '/');
            header('Location: ../memo/');
            return;
        }
    }

    echo '<h4 style="color:red">ログイン失敗しました、メールアドレスとパスワードを確認してください！</h4>';
}

?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <?php include '../../includes/header.php' ?>
    <h2>ログイン</h2>
    <a href="./register.php" class="hyl">
        <div class="btn_register">ユーザー登録はこちら</div>
    </a>
    <form action="./login.php" method="post">
        <p>
            <label>
                メールアドレス
                <input type="text" name="email">
            </label>
        </p>
        <p>
            <label>
                パスワード
                <input type="password" name="password">
            </label>
        </p>
        <p>
            <input type="submit" name="submit_button" value="ログイン" class="sub_btn">
        </p>
    </form>
</body>

</html>
