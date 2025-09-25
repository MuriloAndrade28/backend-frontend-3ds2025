<div class="col-sm-12 mb-4">
    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Alunos
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=aluno/salvar"><i class="bi bi-database-add"></i></a>
                <a class="btn btn-danger float-right mb-3 mr-3" href="?p=aluno/pesquisar">Pesquisar</a>
                <a class="btn btn-warning float-right mb-3 mr-3" href="?p=aluno/paginacao">Paginação</a>
                <a class="btn btn-secondary float-right mb-3 mr-3" href="../api_aluno.php" target="_blank">API</a>
            </h3>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!--consulta php-->
                    <?php
                    include_once '../models/Aluno.php';
                    $aluno = new Aluno();
                    $dados = $aluno->consultar(null);
                    foreach ($dados as $mostrar) {
                    ?>
                        <tr>
                            <td><?= $mostrar['alu_id'] ?></td>
                            <td><?= $mostrar['alu_nome'] ?></td>
                            <td><?= $mostrar['alu_email'] ?></td>
                            <td>
                                <a href="?p=aluno/excluir&id=<?= $mostrar['alu_id'] ?>" class="btn btn-danger" title="Excluir" data-confirm="">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                                <a href="?p=aluno/salvar&id=<?= $mostrar['alu_id'] ?>" class="btn btn-secondary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
