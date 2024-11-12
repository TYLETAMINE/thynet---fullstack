<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    session_start();

    $id = $_SESSION['id'];
    $login = $_SESSION['login'];

    $url = $_SERVER['REQUEST_URI'];
    preg_match('#/([a-z0-9_-]+)#', $url, $match);
    $slug = $match[1];

    $query = "SELECT * FROM users WHERE LOGIN = '$slug'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'] ?></title>

    <link rel="stylesheet" href="./source/style.css">
</head>

<body>
    <div class="wrapper">
        <?php require './components/sidebar.php'; ?>

        <div class="profile__section">
            <div class="section__profile-card">
                <div class="profile-card__background">
                    <div class="profile-card__nameboard">
                        <div class="nameboard__icon">
                            <img src="/source/img/<?= $user['icon_path'] ?>" class="icon__img">
                        </div>

                        <div class="nameboard__username">
                            <div class="username__name">
                                <p><?= $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'] ?></p>
                            </div>

                            <div class="username__subname">
                                <p><?= $user['HOBBY'] ?></p>
                            </div>
                        </div>

                        <div class="nameboard__social"></div>
                    </div>
                </div>

                <div class="profile-card__about">
                    <?php
                    if ($login == $slug) {
                        if (!empty($user['ABOUT'])) {
                            echo
                            '<div class="about__title">
                            <p>Обо мне</p>
                        </div>';
                        } else {
                            echo
                            '<div class="add-info">
                            <p>Добавить информацию?</p>
                        </div>';
                        }
                    } else {
                        if (!empty($user['ABOUT'])) {
                            echo
                            '<div class="about__title">
                            <p>Обо мне</p>
                        </div>';
                        } else {
                            if ($user['SEX'] == 'Мужской') {
                                echo
                                '<div class="add-info">
                                <p>' . $user['FIRST_NAME'] . ' ещё не добавил информацию о себе.</p>
                            </div>';
                            } else {
                                echo
                                '<div class="add-info">
                                <p>' . $user['FIRST_NAME'] . ' ещё не добавила информацию о себе.</p>
                            </div>';
                            }
                        }
                    }
                    ?>
                    <div class="about__subtitle">
                        <p><?= $user['ABOUT'] ?></p>
                    </div>
                </div>
            </div>

            <!-- add friends -->

            <?php if ($login != $slug): ?>
                <div class="friends__accept">
                    <form method="post" class="form_send">
                        <input name="message" type="submit" value="Отправить сообщение" class="send_message" />

                        <?php require './components/addFriend.php'; ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>