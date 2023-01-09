<?php
include_once "./base.php";

$table = $_POST['table'];
prr($_POST);
if (isset($_POST['id'])) {
    foreach (($_POST['id']) as $id) {
        $row = $$table->find($id);
        prr($row);
        if (in_array($row['id'], $_POST['del'])) {
            $$table->del($id);
        } else {
        }
    }

    // to('../back.php?do=' . lcfirst($table));
}
