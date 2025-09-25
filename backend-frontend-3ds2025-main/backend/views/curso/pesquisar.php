<div class="col-sm-12 mb-4">

    <div class="card shadow mb-4">
        <div class="table-responsive-sm mt-4">
            <h3 class="ml-3">
                Listar Estados
                <a class="btn btn-success float-right mb-3 mr-3" href="?p=estado/salvar">
                    <i class="bi bi-database-add"></i>
                </a>
            </h3>

            <!-- Filtros -->
            <form id="form-filtro" class="form-inline mb-3 ml-3" method="post">
                <input type="text" class="form-control mr-2" name="nome" placeholder="Nome">
                <input type="text" class="form-control mr-2" name="sigla" placeholder="Sigla">
                <input type="submit" class="btn btn-primary" name="enviar" value="Pesquisar">
                <button type="reset" id="btn-reset" class="btn btn-secondary ml-2">Limpar</button>
            </form>

            <table class="table table-striped table-sm" id="tabela-estados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>UF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (filter_input(INPUT_POST, 'enviar')) {

                        $nome = filter_input(INPUT_POST, 'nome');
                        $sigla = filter_input(INPUT_POST, 'sigla');

                        $filtros = [];
                        if (empty($nome) && empty($sigla)) {
                            echo "<script>alert('Preencha ao menos um campo para pesquisar');</script>";
                            exit;
                        } else if (!empty($nome)) {
                            $filtros[0] = 'nome';
                            $filtros[1] = $nome;
                        } else if (!empty($sigla)) {
                            $filtros[0] = 'sigla';
                            $filtros[1] = $sigla;
                        }

                        include_once '../models/Estado.php';
                        $estado = new Estado();
                        $dados = $estado->pesquisar(filtros: $filtros);
                        foreach ($dados as $mostrar) { ?>
                            <tr>
                                <td><?= $mostrar['est_id'] ?></td>
                                <td><?= $mostrar['est_nome'] ?></td>
                                <td><?= $mostrar['est_uf'] ?></td>
                                <td>
                                    <a href="?p=estado/excluir&id=<?= $mostrar['est_id'] ?>" class="btn btn-danger btn-sm" title="Excluir">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                    <a href="?p=estado/salvar&id=<?= $mostrar['est_id'] ?>" class="btn btn-secondary btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>