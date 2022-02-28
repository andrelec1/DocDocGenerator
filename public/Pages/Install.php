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
    (new TitleElement('# Install'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
);

$document->addElements([
    (new TitleElement('Index'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
        ->titleSize(TitleSize::H2)
        ->padding(1)
        ->addContentModifier($paginator),
    (new SimpleTextElement('
        Create index.php like this:
    '))
    ->padding(2),
    (new SimpleCodeBlockElement('
use App\Kernel;

require dirname(__DIR__).\'/vendor/autoload.php\';

$documentation = new Kernel();

// Option here

$documentation->render();
'
    ))
        ->padding(2),
    ]
);

$document->addElements([
    (new TitleElement('Title'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
        ->titleSize(TitleSize::H2)
        ->padding(1)
        ->addContentModifier($paginator),
    (new SimpleTextElement('Setup Documentation title with:'))
        ->padding(2),
    (new SimpleCodeBlockElement('
    $documentation->setTitle(\'DocDocGenerator\');
    '))
        ->padding(2),
    ]
);

$document->render();
