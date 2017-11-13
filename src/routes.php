<?php
$routes = [
    'metadata',
    'getImageFromUrl',
    'getImageFromHtml'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

