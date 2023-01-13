<?php
include_once "./base.php";

$table = $_POST['table'];
$subject = $$table->find($_POST['subject_id']);
$subject['count']++;
$$table->save($subject);

$option = $$table->find($_POST['id']);
$option['count']++;
$$table->save($option);

to('../index.php?do=' . lcfirst($table));
?>