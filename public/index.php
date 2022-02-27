<?php

use App\Kernel;

require dirname(__DIR__).'/vendor/autoload.php';

$documentation = new Kernel();

$documentation->setTitle('DocDocGenerator');
$documentation->loadMenu([
    'DocDocGenerator' => 'DocDocGenerator',
    'Install' => 'Install'
]);

$documentation->render();
