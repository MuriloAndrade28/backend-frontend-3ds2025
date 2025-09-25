<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Cursos
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=curso/salvar"><i class="bi bi-database-add"></i></a>
                <a class="btn btn-danger float-right mb-3 mr-3" href="?p=curso/pesquisar">Pesquisar</i></a>
                <a class="btn btn-warning float-right mb-3 mr-3" href="?p=curso/paginacao">Paginação</i></a>
                <a class="btn btn-secondary float-right mb-3 mr-3" href="../api_curso.php" target="_blank">API</i></a>
            </h3>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Curso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!--consulta php-->
                    <?php
                    include_once '../models/Curso.php';
                    $curso = new Curso();
                    $dados = $curso->consultar(null);
                    foreach ($dados as $mostrar) {
                    ?>
                        <tr>
                            <td><?= $mostrar['cur_id'] ?></td>
                            <td><?= $mostrar['cur_nome'] ?></td>
                            <td>
                                <a href="?p=curso/excluir&id=<?= $mostrar['cur_id'] ?>" class="btn btn-danger" title="Excluir" data-confirm="">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                                <a href="?p=curso/salvar&id=<?= $mostrar['cur_id'] ?>" class="btn btn-secondary" title="Editar">
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
