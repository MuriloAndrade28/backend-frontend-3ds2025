<?php
//capturar id da url
$id = filter_input(INPUT_GET, 'id');

include_once '../models/Estado.php';
$estado = new Estado();

if (isset($id)) {
    $dados = $estado->consultar($id);
    foreach ($dados as $mostrar) {
        $nome = $mostrar['est_nome'];
        $uf = $mostrar['est_uf'];
    }
}
?>
<div class="card shadow col-md-8 col-sm-12">
    <h3 class="ml-3 mt-3 text-primary">
        <?= isset($id) ? "Editar " : "Cadastrar " ?> Estado
    </h3>
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <?= isset($id) ? "ID " . $id : "" ?>

        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Nome
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Estado"
                    value="<?= isset($id) ? $nome : "" ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputText" class="col-sm-2 col-form-label">
                Sigla - UF
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtsigla" name="txtsigla" placeholder="UF"
                    value="<?= isset($id) ? $uf : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                    class="btn <?= isset($id) ? "btn-success" : "btn-primary" ?>"
                    name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>"
                    value="<?= isset($id) ? "Editar" : "Salvar" ?>">
            </div>
            <a href="?p=estado/consultar" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $uf = filter_input(INPUT_POST, 'txtsigla');

    include_once '../models/Estado.php';
    $estado = new Estado();

    $estado->setId(NULL);
    $estado->setNome($nome);
    $estado->setuf($uf);

    if ($estado->crud(0)) {
        ?>
        <div class="alert alert-primary mt-3" role="alert">
            Cadastro efetuado com sucesso
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=estado/consultar">
        <?php
    }
}

if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $uf = filter_input(INPUT_POST, 'txtsigla');

    $estado->setId($id);
    $estado->setNome($nome);
    $estado->setuf($uf);

    if ($estado->crud(1)) {
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Editado efetuado com sucesso
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=estado/consultar">
        <?php
    }
}
