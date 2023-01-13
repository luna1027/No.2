<?php
include_once "./base.php";

$table = $_POST['table'];
// prr($_POST);
if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $idx => $id) {
        // echo $id;
        $row = $$table->find($id);
        if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
            $$table->del($id);
        } else {
            $row['sh'] = isset($_POST['sh']) && in_array($id, $_POST['sh']) ? 1 : 0;
        }
        // prr($row);
        $$table->save($row);
    }
}

to('../back.php?do=' . lcfirst($table));
?>