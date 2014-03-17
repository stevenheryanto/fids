<?php
/* on fly delete */
require_once 'lib/meekrodb.2.1.class.php';
$id = $_POST['id'];
$table = $_POST['table'];
DB::delete($table, "id=%s", $id);
?>
