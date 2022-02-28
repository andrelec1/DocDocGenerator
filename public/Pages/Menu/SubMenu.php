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
    (new TitleElement('subMenuLink:'))
        ->textDecorationStyle(TextDecoration::UNDERLINE)
        ->titleSize(TitleSize::H2)
);

$document->addElement(
    (new SimpleTextElement("You can call ->addSubLink(\$menuLink) on MenuLink object to add subLink ...<br />
    SubLink is rendered with 20px padding."))
);
$document->addElement((new SimpleCodeBlockElement('
    (new MenuLink($name, ?$path))
        ->addSubLink((new MenuLink($name, ?$path))
            ->addSubLink(new MenuLink($name, ?$path))
        )
    ;
'
)));

$document->render();
