<?php

use DocGenerator\DocumentGenerator;
use DocGenerator\Enum\TextDecoration;
use DocGenerator\Enum\TitleSize;
use DocGenerator\Model\Code\SimpleCodeBlockElement;
use DocGenerator\Model\List\SimpleListElement;
use DocGenerator\Model\Text\SimpleTextElement;
use DocGenerator\Model\Title\TitleElement;

require dirname(__DIR__).'/../../vendor/autoload.php';

$document = new DocumentGenerator();
$document->addElement(
    (new TitleElement('# Menu'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
);

$document->addElement(
    (new TitleElement('MenuLink object:'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
        ->titleSize(TitleSize::H2)
);

$document->addElement(
    (new SimpleTextElement('MenuLink Obj'))
);
$document->addElement((new SimpleCodeBlockElement('
    new MenuLink($name, ?$path);
'
)));
$document->addElement(
    (new SimpleListElement())
        ->addStringElement('$name: String Display in menu')
        ->addStringElement('$path: Path to the file with ext (.php), if null link isn\'t clickable')
);

$document->addElement(
    (new TitleElement('Adding menu:'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
        ->titleSize(TitleSize::H2)
);

$document->addElement(
    (new SimpleTextElement('Adding MenuLink or Array of MenuLink to $documentation for generating documentation menu.'))
);

$document->addElements([
    (new SimpleCodeBlockElement('
$documentation->addMenuLink(
    new MenuLink(\'DocDocGenerator\', \'Pages/DocDocGenerator\'),
);
'
    )),
    (new SimpleCodeBlockElement('
$documentation->addMenuLinks([
    new MenuLink(\'DocDocGenerator\', \'Pages/DocDocGenerator\'),
    new MenuLink(\'OtherPage\', \'Pages/OtherPage\'),
]);
'
    )),
]);

$document->render();
