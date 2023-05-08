<?php

require_once __DIR__ . '/../../models/User.php';

session_start();

$emailError = null;
$passwordError = null;
$nameError = null;

if (isset($_POST['submit_button'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // var_dump($_POST['email']);
    // var_dump($emailError);

    if (empty($_POST['email'])) {
        $emailError = "メールアドレスが入力されいない！";
    } else if (User::existsEmail($email)) {
        $emailError = "メールアドレスが重複してるよ！";
    }


    if (empty($_POST['password'])) {
        $passwordError = "パスワードが入力されいない！";
    }

    if (empty($_POST['name'])) {
        $nameError = "名前が入力されいない！";
    }


    if (is_null($emailError) && is_null($passwordError) && is_null($nameError)) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setName($name);

        $user->register();

        $_SESSION['user'] = $user;
        setcookie('userId', $user->getId(), time() + 60 * 60 * 24 * 30, '/');

        header('Location: ../memo/');
        return;
    }
}

?>
<html>
<?php include '../../includes/head.php' ?>

<body>
    <script src="../js/register.js" defer></script>
    <?php include '../../includes/header.php' ?>
    <h2>ユーザー登録</h2>
    <a href="./login.php" class="hyl">
        <div class="btn_login">ログインはこちら</div>
    </a>
    <form action="./register.php" method="post">

        <p>
            <label>
                メールアドレス
                <input type="text" name="email" class="input_email">
            </label>
        <div class="error">
            <?php if (!is_null($emailError)) : ?>
                <?php echo $emailError ?>
            <?php endif ?>
        </div>
        </p>

        <p>
            <label>
                パスワード
                <input type="password" name="password">
            </label>
        <div class="error">
            <?php if (!is_null($passwordError)) : ?>
                <?php echo $passwordError ?>
            <?php endif ?>

        </div>
        </p>
        <p>
            <label>
                お名前
                <input type="text" name="name">
            </label>
        <div class="error">
            <?php if (!is_null($nameError)) : ?>
                <?php echo $nameError ?>
            <?php endif ?>

        </div>
        </p>
        <p>
            <input type="submit" name="submit_button" value="登録" class="sub_btn">
        </p>
    </form>
</body>

</html>
