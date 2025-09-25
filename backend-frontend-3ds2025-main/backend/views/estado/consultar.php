<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Estados
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=estado/salvar"><i class="bi bi-database-add"></i></a>
                <a class="btn btn-danger float-right mb-3 mr-3" href="?p=estado/pesquisar">Pesquisar</i></a>
                <a class="btn btn-warning float-right mb-3 mr-3" href="?p=estado/paginacao">Paginação</i></a>
                <a class="btn btn-secondary float-right mb-3 mr-3" href="../api_estado.php" target="_blank">API</i></a>
            </h3>

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>UF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!--consulta php-->
                    <?php
                    include_once '../models/Estado.php';
                    $estado = new Estado();
                    $dados = $estado->consultar(null);
                    foreach ($dados as $mostrar) {
                    ?>
                        <tr>
                            <td><?= $mostrar['est_id'] ?></td>
                            <td><?= $mostrar['est_nome'] ?></td>
                            <td><?= $mostrar['est_uf'] ?></td>
                            <td>
                                <a href="?p=estado/excluir&id=<?= $mostrar['est_id'] ?>" class="btn btn-danger" title="Excluir" data-confirm="">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                                <a href="?p=estado/salvar&id=<?= $mostrar['est_id'] ?>" class="btn btn-secondary" title="Editar">
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