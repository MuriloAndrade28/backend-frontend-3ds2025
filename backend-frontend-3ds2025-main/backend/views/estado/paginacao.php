<?php
include_once '../models/Estado.php';
$estado = new Estado();

// total de registros
$total = $estado->totalRegistros();

// define página atual (via GET)
$pagina = filter_input(INPUT_GET, 'pagina') ? (int) filter_input(INPUT_GET, 'pagina') : 1;
$limite = 5;

// busca os dados paginados
$dados = $estado->paginar($pagina, $limite);

// calcula número total de páginas
$totalPaginas = ceil($total / $limite);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>UF</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $mostrar): ?>
            <tr>
                <td><?= $mostrar['est_id'] ?></td>
                <td><?= $mostrar['est_nome'] ?></td>
                <td><?= $mostrar['est_uf'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Paginação -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                <a class="page-link" href="?p=estado/paginacao&pagina=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>