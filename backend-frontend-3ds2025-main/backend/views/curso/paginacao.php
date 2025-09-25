<?php
include_once '../models/Curso.php';
$curso = new Curso();

// total de registros
$total = $curso->totalRegistros();

// define página atual (via GET)
$pagina = filter_input(INPUT_GET, 'pagina') ? (int) filter_input(INPUT_GET, 'pagina') : 1;
$limite = 5;

// busca os dados paginados
$dados = $curso->paginar($pagina, $limite);

// calcula número total de páginas
$totalPaginas = ceil($total / $limite);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $mostrar): ?>
            <tr>
                <td><?= $mostrar['cur_id'] ?></td>
                <td><?= $mostrar['cur_nome'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Paginação -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                <a class="page-link" href="?p=curso/paginacao&pagina=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
