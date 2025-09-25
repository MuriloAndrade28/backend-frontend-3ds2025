 <?php
include_once '../models/Aluno.php';
$aluno = new Aluno();

// total de registros
$total = $aluno->totalRegistros();

// define página atual (via GET)
$pagina = filter_input(INPUT_GET, 'pagina') ? (int) filter_input(INPUT_GET, 'pagina') : 1;
$limite = 5;

// busca os dados paginados
$dados = $aluno->paginar($pagina, $limite);

// calcula número total de páginas
$totalPaginas = ceil($total / $limite);
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $mostrar): ?>
            <tr>
                <td><?= $mostrar['alu_id'] ?></td>
                <td><?= $mostrar['alu_nome'] ?></td>
                <td><?= $mostrar['alu_email'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Paginação -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                <a class="page-link" href="?p=aluno/paginacao&pagina=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
