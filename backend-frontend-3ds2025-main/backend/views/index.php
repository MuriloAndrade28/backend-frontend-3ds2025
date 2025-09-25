<?php
include_once 'localizacao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    include_once 'cabecalho.php';
    ?>
</head>

<body>

    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12">
                <?php
                $pagina = filter_input(INPUT_GET, 'p');

                if (empty($pagina) || $pagina == 'index' || $pagina == 'index.php') {
                    include_once 'pagina-inicial.php';
                } else {
                    if (file_exists($pagina . '.php')) {
                        include_once $pagina . '.php';
                    } else {
                        echo '<div class="alert alert-danger" role="alert" mt-4>'
                            . '<h3>Erro 404</h3>'
                            . '<p>Página não encontrada!</p>'
                            . '</div>';
                    }
                }
                ?>
            </div>
        </div><!--fim linha conteúdo-->
    </div>

    <?php
    include_once 'scripts.php';
    ?>

</body>

</html>