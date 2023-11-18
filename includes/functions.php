<?php 
define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCTIONS_URL", "functions.php");

function includeTemplate($template) {
    include TEMPLATES_URL . "/$template.php";
}

function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}
?>