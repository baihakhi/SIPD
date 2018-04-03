<?php

include('../include/function.php');

$id = readInput($_POST['id']);

echo hapusData($id);
?>
