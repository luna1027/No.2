<?php
include_once "./base.php";

$reg = $User->count(['acc' => $_POST['acc']]);
if ($reg == 0) {
    echo $reg;
    unset($_POST['cfmpw']);
    $User->save($_POST);
} else {
    echo $reg;
}


// $User->save(['acc' => $_POST['acc'], 'pw' => $_POST['pw'], 'mail' => $_POST['mail']]);
