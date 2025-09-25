<?php
$id = filter_input(INPUT_GET, 'id');

if ($id) {
    include_once '../models/Aluno.php';
    $aluno = new Aluno();
    $aluno->setId($id);
    $aluno->crud(0);  
}
?>
<meta http-equiv="refresh" CONTENT="0.2;URL=?p=aluno/consultar">
