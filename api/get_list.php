<?php
include_once "./base.php";

$type = $_GET['type'];
$lists = $News->all(['type' => $type]);

foreach ($lists as $list) {
    echo "<a href='#' style='display:block;' onclick='getNews({$list['id']})'>" . $list['title'] . "</a>";
}
