<?php
$query = "SELECT * FROM friends WHERE ID1 = '$id' OR ID2 = '$id'";
$res = mysqli_query($link, $query);
$friend = mysqli_fetch_assoc($res);

if ($friend['ID1'] != $id) {
    $f_id = $friend['ID1'];

    $query = "SELECT * FROM users WHERE ID = '$f_id'";
    $res = mysqli_query($link, $query);
    $friends = mysqli_fetch_assoc($res);

    echo '<a href="' . $friends['LOGIN'] . '">' . $friends['FIRST_NAME'] . ' ' . $friends['LAST_NAME']  . '</a>';
}

if ($friend['ID2'] != $id) {
    $f_id = $friend['ID2'];

    $query = "SELECT * FROM users WHERE ID = '$f_id'";
    $res = mysqli_query($link, $query);
    $friends = mysqli_fetch_assoc($res);

    echo '<a href="' . $friends['LOGIN'] . '">' . $friends['FIRST_NAME'] . ' ' . $friends['LAST_NAME']  . '</a>';
}
