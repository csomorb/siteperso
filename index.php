<?php
/**
 * Created by PhpStorm.
 * User: Csomor Barnabas
 * Date: 12/10/2016
 * Time: 23:43
 */
$querystring = htmlspecialchars($_SERVER['QUERY_STRING']);
if (empty($querystring)) {
    $params = "accueil";
}
else {
    $params = $querystring;
}
$folder = explode("/", $params)[0];
$page = "pages/" . $params . ".php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Barnabas Csomor</title>
    <link href="https://fonts.googleapis.com/css?family=Hind" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <?php if ($folder == "hobbies") { echo "<link rel='stylesheet' href='css/photoswipe.css' type='text/css'>"; } ?>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="description" content="Barnabas Csomor, 25 ans, passioné par les technologies du web">
    <meta name="keywords" content="Barnabas,Csomor,développeur,web,symfony,php,angular2,javascipt,stage,master,grenoble,alpes,université">
    <meta name="author" content="Barnabas Csomor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
</head>
<body>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper">
        <a href="/accueil" class="brand-logo">Barnabas Csomor</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li class="sliding-middle-out"><a href="/dev" <?php if ($folder == "dev") { echo "class='active'"; } ?>>Développement Web</a></li>
            <li class="sliding-middle-out"><a href="/parcours" <?php if ($folder == "parcours") { echo "class='active'"; } ?>>Parcours</a></li>
            <li class="sliding-middle-out"><a href="/hobbies" <?php if ($folder == "hobbies") { echo "class='active'"; } ?>>Centres d’intérêt</a></li>
            <li class="sliding-middle-out"><a href="./files/cv_Barnabas_Csomor.pdf" target="_blank">CV</a></li>
            <li class="sliding-middle-out"><a href="#contact">Contact</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="/dev">Développement Web</a></li>
            <li><a href="/parcours">Parcours</a></li>
            <li><a href="/hobbies">Centres d’intérêt</a></li>
            <li><a href="./files/cv_Barnabas_Csomor.pdf" target="_blank">CV</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
</nav>
</div>
<?php
if (file_exists($page)) {
    require_once($page);
}
else {
    require_once("404.php");
}
?>
<script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    });

</script>

</body>
</html>