<?php

use DocGenerator\ContentModifier\PaginationModifier;
use DocGenerator\DocumentGenerator;
use DocGenerator\Enum\TextDecoration;
use DocGenerator\Enum\TitleSize;
use DocGenerator\Model\Code\SimpleCodeBlockElement;
use DocGenerator\Model\Text\SimpleTextElement;
use DocGenerator\Model\Title\TitleElement;

require dirname(__DIR__).'/../vendor/autoload.php';

$document = new DocumentGenerator();
$paginator = new PaginationModifier();
$document->addElement(
    (new TitleElement('# Use'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
);

$document->addElements([
        (new TitleElement('Pages'))
            ->textDecorationStyle(TextDecoration::UNDERLINE)
            ->titleSize(TitleSize::H2)
            ->padding(1)
            ->addContentModifier($paginator),
        (new SimpleTextElement('Create some page like this in sub-folder:'))
            ->padding(2),
        (new SimpleCodeBlockElement('
use DocGenerator\DocumentGenerator;
use DocGenerator\Enum\TextAlign;
use DocGenerator\Model\Title\TitleElement;

require dirname(__DIR__).\'/../vendor/autoload.php\';

$document = new DocumentGenerator();
$document->addElement(
    (new TitleElement(\'DocDocGenerator\'))
        ->textAlign(TextAlign::CENTER)
);

$document->render();
    '))
            ->padding(2),
    ]
);



$document->render();
