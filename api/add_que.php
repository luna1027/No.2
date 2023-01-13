<?php
include_once "./base.php";

// prr($_POST);
if (isset($_POST['subject']) && $_POST['subject'] !== "") {
    $Que->save(['text' => $_POST['subject'], 'count' => 0, 'parent' => 0]);
}

$id = $Que->find(['text' => $_POST['subject']])['id'];
if (isset($_POST['option']) && $_POST['option'] !== "") {
    foreach ($_POST['option'] as $opt) {
        $Que->save(['text' => $opt, 'count' => 0, 'parent' => $id]);
    }
}

// function test($testarray,$id){
//     global $Que;
//     foreach ($testarray as $test) {
//         $test=$Que->save(['text' => $test, 'count' => 0, 'parent' => $id]);
//     }
// }
// prr($Que->save(['text' => $opt, 'count' => 0, 'parent' => $id]));
to("../back.php?do=que");
