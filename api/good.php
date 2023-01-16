<?php
include_once "./base.php";
prr($_POST);
$news = $_POST['news'];
$user = $_POST['user'];

$chk = $Log->count(['news' => $news, 'acc' => $user]);
prr($chk);
$row = $News->find($news);
// prr($row);
if ($chk > 0) {
    $Log->del(['news' => $news, 'acc' => $user]);
    $row['good']--;
    $News->save($row);
} else {
    $row['good']++;
    $Log->save(['news' => $news, 'acc' => $user]);
    $News->save($row);
}
