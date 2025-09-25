<?php
// Capturar id da URL
$id = filter_input(INPUT_GET, 'id');

include_once '../models/Aluno.php';
$aluno = new Aluno();


if (isset($id)) {
    $dados = $aluno->consultar($id);
    foreach ($dados as $mostrar) {
        $nome = $mostrar['alu_nome'];
        $email = $mostrar['alu_email'];
    }
}
?>

<div class="card shadow col-md-8 col-sm-12">
    <h3 class="ml-3 mt-3 text-primary">
        <?= isset($id) ? "Editar " : "Cadastrar " ?> Aluno
    </h3>
    <form method="post" name="formsalvar" id="formSalvar" class="m-3" enctype="multipart/form-data">
        <?= isset($id) ? "ID " . $id : "" ?>

        <div class="form-group row">
            <label for="txtnome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Nome do aluno"
                    value="<?= isset($nome) ? $nome : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email do aluno"
                    value="<?= isset($email) ? $email : "" ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit"
                    class="btn <?= isset($id) ? "btn-success" : "btn-primary" ?>"
                    name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>"
                    value="<?= isset($id) ? "Editar" : "Salvar" ?>">
            </div>
            <a href="?p=aluno/consultar" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>

<?php
// Ação de salvar novo aluno
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');

    $aluno = new Aluno();
    $aluno->setId(NULL);
    $aluno->setNome($nome);
    $aluno->setEmail($email);

    if ($aluno->crud(0)) { // 0 = inserir
        ?>
        <div class="alert alert-primary mt-3" role="alert">
            Cadastro efetuado com sucesso
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=aluno/consultar">
        <?php
    }
}

// Ação de editar aluno existente
if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');

    $aluno->setId($id);
    $aluno->setNome($nome);
    $aluno->setEmail($email);

    if ($aluno->crud(1)) { // 1 = editar
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Edição efetuada com sucesso
        </div>
        <meta http-equiv="refresh" content="0.2;URL=?p=aluno/consultar">
        <?php
    }
}
?>
