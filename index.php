<?php
require './code/connect.php';

$url = $_SERVER['REQUEST_URI'];
preg_match('#/([a-z0-9_-]+)#', $url, $match);
$slug = $match[1];

$query = "SELECT * FROM pages WHERE SLUG = '$slug'";
$res = mysqli_query($link, $query) or die(mysqli_error($link));
$page = mysqli_fetch_assoc($res);

switch ($page['TYPE']) {
    case 'auth':
        require './view/auth.php';
        break;

    case 'logout':
        require './code/logout.php';
        break;

    case 'profile':
        require './view/profile.php';
        break;

    case 'friends':
        require './view/friends.php';
        break;
    
    default:
        require './view/404.php';
        break;
}