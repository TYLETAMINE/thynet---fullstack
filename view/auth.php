<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>

<body>
    <div class="authentication">
        <form method="post">
            <input type="text" name="login">
            <input type="password" name="password">

            <input type="submit" value="Войти">
        </form>

        <?php
        require './code/connect.php';
        session_start();

        if (!empty($_POST['password']) and !empty($_POST['login'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE LOGIN = '$login' AND PASSWORD = '$password'";
            $res = mysqli_query($link, $query);
            $user = mysqli_fetch_assoc($res);

            if (!empty($user)) {
                $_SESSION['auth'] = true;

                $_SESSION['id'] = $user['ID'];
                $_SESSION['login'] = $user['LOGIN'];
                $_SESSION['status'] = $user['status'];

                header('Location: /' . $user['LOGIN'] . '');
            } else {
                echo 'Пароль или логин не верный';
            }
        } else {
            echo 'Заполните все поля';
        }
        ?>
    </div>
</body>

</html>