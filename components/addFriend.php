<?php
$sender = $login;
$taker = $user['LOGIN'];

$query = "SELECT * FROM `friend-request` WHERE SENDER = '$taker' AND TAKER = '$sender'";
$res = mysqli_query($link, $query);
$acceptFriend = mysqli_fetch_assoc($res);

if ($acceptFriend['ACCEPT'] == '0'): ?>

    <input name="acceptFriend" type="submit" value="Принять заявку" class="accept_request" />

<?php elseif ($acceptFriend['ACCEPT'] == '1'): ?>

    <input type="button" value="Вы друзья" class="friend_button" />

    <?php else:
    $query = "SELECT * FROM `friend-request` WHERE SENDER = '$sender' AND TAKER = '$taker'";
    $res = mysqli_query($link, $query);
    $addFriend = mysqli_fetch_assoc($res);

    if ($addFriend['SENDER'] == $sender and $addFriend['TAKER'] == $taker and $addFriend['ACCEPT'] == '0'): ?>

        <input name="cancelFriend" type="submit" value="Отменить заявку" class="cancel_request" />

    <?php elseif ($addFriend['SENDER'] != $sender and $addFriend['TAKER'] != $taker and $addFriend['ACCEPT'] != '0') : ?>

        <input name="addFriend" type="submit" value="Добавить в друзья" class="send_request" />

    <?php else: ?>

        <input type="button" value="Вы друзья" class="friend_button" />

    <?php endif; ?>

<?php endif;


if (isset($_POST['addFriend'])) {
    $query = "INSERT INTO `friend-request` SET SENDER = '$sender', TAKER = '$taker'";
    mysqli_query($link, $query);

    echo '<script>location.reload()</script>';
}

if (isset($_POST['cancelFriend'])) {
    $query = "DELETE FROM `friend-request` WHERE SENDER = '$sender' AND TAKER = '$taker'";
    mysqli_query($link, $query);

    echo '<script>location.reload()</script>';
}

if (isset($_POST['acceptFriend'])) {
    $query = "UPDATE `friend-request` SET ACCEPT = '1' WHERE SENDER = '$taker' AND TAKER = '$sender'";
    mysqli_query($link, $query);

    $query = "SELECT * FROM users WHERE LOGIN = '$taker'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);

    $id1 = $user['ID'];

    $query = "SELECT * FROM users WHERE LOGIN = '$sender'";
    $res = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($res);

    $id2 =  $user['ID'];

    $query = "INSERT INTO friends SET ID1 = '$id1', ID2 = '$id2'";
    mysqli_query($link, $query);

    echo '<script>location.reload()</script>';
} ?>