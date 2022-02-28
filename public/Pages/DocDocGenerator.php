<?php

use DocGenerator\DocumentGenerator;
use DocGenerator\Enum\TextAlign;
use DocGenerator\Model\Title\TitleElement;

require dirname(__DIR__).'/../vendor/autoload.php';

$document = new DocumentGenerator();
$document->addElement(
    (new TitleElement('DocDocGenerator'))
        ->textAlign(TextAlign::CENTER)
);

$document->render();
