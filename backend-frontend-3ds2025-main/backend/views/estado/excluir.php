<?php
$id = filter_input(INPUT_GET, 'id');

if ($id) {
  include_once '../models/Estado.php';
  $estado = new Estado();
  $estado->setId($id);
  $estado->crud(0);
}
?>
<meta http-equiv="refresh" CONTENT="0.2;URL=?p=estado/consultar">