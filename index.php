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
<html>
<head>
    <meta charset="UTF-8">
    <title>Barnabas Csomor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
</head>
<body>

<?php
if (file_exists($page)) {
    require_once($page);
}
else {
    require_once("404.php");
}
?>


</body>
</html>