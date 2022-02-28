<?php

use App\Kernel;
use App\MenuLink;

require dirname(__DIR__).'/vendor/autoload.php';

$documentation = new Kernel();

$documentation->setTitle('DocDocGenerator');

$documentation->addMenuLinks([
    new MenuLink('DocDocGenerator', 'Pages/DocDocGenerator'),
    new MenuLink('Install', 'Pages/Install'),
    new MenuLink('Pages', 'Pages/Pages'),
    (new MenuLink('Menu'))
        ->addSubLink(new MenuLink('Menu', 'Pages/Menu/Menu'))
        ->addSubLink(new MenuLink('SubMenu', 'Pages/Menu/SubMenu')),
]);

$documentation->render();
