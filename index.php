<!DOCTYPE HTML>
<html>
<head>
    <title>Concesionario Multimarca</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body id="top">

<section id="banner">
    <div class="inner">
        <header>
            <h1>Concesionario Multimarca</h1>
            <p>Somos un Concesionario Multimarca Líder en su sector.</p>
            <p>Calidad y Precio garantizado</p>
        </header>
        <a href="#main" class="more">Learn More</a>
    </div>
</section>

<div id="main">
    <div class="inner">
        <div class="thumbnails">
            <?php
            require_once 'GestionAutomoviles.php';
            $gestionAutomoviles = new GestionAutomoviles();

            $marcasUrls = $gestionAutomoviles->ObtenerMarcasUrl();

            foreach ($marcasUrls as $marca => $url) {
                $modelos = $gestionAutomoviles->obtenerModelosPorMarca($marca);
                ?>
                <div class="box">
                    <a href="<?= $url ?>" class="image fit" title="ver video"><img src="images/<?= strtolower(str_replace(' ', '_', $marca)) ?>.png" alt="logo <?= $marca ?>" /></a>
                    <div class="inner">
                        <h3><span onclick="mostrarModelos('modelos-<?= $marca ?>')">Modelos <?= $marca ?></span></h3>
                        <div id="modelos-<?= $marca ?>" style="display: none;">
                            <?php foreach ($modelos as $modelo) { ?>
                                <p><?= $modelo ?></p>
                            <?php } ?>
                        </div>
                        <a href="<?= $url ?>" class="button style2 fit" data-poptrox="youtube,800x400">Ver video <?= $marca ?></a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<footer id="footer">
    <div class="inner">
        <h2>Sigue nuestras redes sociales</h2>
        <p>A responsive video gallery template with a functional lightbox<br />
            designed by <a href="https://templated.co/">Templated</a> and released under the Creative Commons License.</p>
        <ul class="icons">
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
        </ul>
        <p class="copyright">&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com/">Unsplash</a>. Videos: <a href="http://coverr.co/">Coverr</a>.</p>
    </div>
</footer>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.poptrox.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

<script>
    function mostrarModelos(marca) {
        var modelosList = document.getElementById(marca);

        if (modelosList.style.display === 'none' || modelosList.style.display === '') {
            modelosList.style.display = 'block';
        } else {
            modelosList.style.display = 'none';
        }
    }
</script>

</body>
</html>
