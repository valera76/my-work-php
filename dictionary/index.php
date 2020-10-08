<?php

function render(string $templatesPath) {
    ob_start();
    include $templatesPath;
    $content = ob_get_content();
    ob_end_clean();
    
    return $content;
}

if ($_SERVER['REQUEST_URI'] === '/') {
    $response = render(__DIR__ . '/templates/main.php');
    echo $response;
    exit(0);
}

if ($_SERVER['REQUEST_URI'] === '/Translate') {
    $response = render(__DIR__ . '/templates/translate.php');
    echo $response;
    exit(0);
}

if ($_SERVER['REQUEST_URI'] === '/Dictionary') {
    $response = render(__DIR__ . '/src/dictionary.php');
    echo $response;
    exit(0);
}

if ($_SERVER['REQUEST_URI'] === '/Sing up') {
    $response = render(__DIR__ . '/templates/singup.php');
    echo $response;
    exit(0);
}

if ($_SERVER['REQUEST_URI'] === '/Log in') {
    $response = render(__DIR__ . '/templates/login.php');
    echo $response;
    exit(0);
}



