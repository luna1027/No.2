<?php
include_once "./base.php";

$table = $_POST['table'];
prr($_POST['del']);

if (isset($_POST['del'])) {
    foreach ($_POST['del'] as $id) {
        echo $id;
        $$table->del($id);
    }
}

to('../back.php?do=' . lcfirst($table));
