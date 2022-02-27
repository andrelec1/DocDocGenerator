<?php

use App\DocumentGenerator;
use App\Enum\TextAlign;
use App\Model\Title\TitleElement;

require dirname(__DIR__).'/../vendor/autoload.php';

$document = new DocumentGenerator();
$document->addElement(
    (new TitleElement('DocDocGenerator'))
        ->textAlign(TextAlign::CENTER)
);

$document->render();
