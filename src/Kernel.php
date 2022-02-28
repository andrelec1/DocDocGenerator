<?php

namespace App;

class Kernel
{
    /** @var array|string[] */
    private array $menu = [];

    /** @var string  */
    private string $title = '';

    /**
     * @param MenuLink $menuLink
     * @return $this
     */
    public function addMenuLink(MenuLink $menuLink): self
    {
        $this->menu[] = $menuLink;

        return $this;
    }

    /**
     * @param array $menuLinks
     * @return $this
     */
    public function addMenuLinks(array $menuLinks): self
    {
        array_push($this->menu, ...$menuLinks);

        return $this;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function getCurrentPage(): string
    {
        if (isset($_GET['page'])) {
            return $_GET['page'];
        }

        return $this->menu[array_key_first($this->menu)];
    }

    /**
     * @param string $text
     * @param string $path
     * @return string
     * @throws \ReflectionException
     */
    private function linkGenerator(MenuLink $menuLink, int $deep = 0): string
    {
        $reflectionMethod = new \ReflectionMethod(get_class($menuLink), 'getInfo');
        $reflectionMethod->setAccessible(true);
        $obj = $reflectionMethod->invoke($menuLink);

        $paddingLeft = $deep > 0 ? 'style="padding-left: '. $deep * 30 + 8 .'px"' : '';

        $balise = '';
        if ($obj['path'] === null ) {
            $balise = "<p $paddingLeft>" . $obj['name'] . '</p>';
        } else {
            $balise = "<a $paddingLeft";
            $balise .= 'href="?page=' . $obj['path'] . '" ';

            if ($obj['path'] === $this->getCurrentPage()) {
                $balise .= ' class="active"';
            }
            $balise .= '>' . $obj['name'] . '</a>';
        }

        $sublinks = '';
        if (count($obj['subLinks']) > 0) {
            foreach ($obj['subLinks'] as $subLink) {
                $sublinks .= $this->linkGenerator($subLink, $deep + 1);
            }
        }

        return $balise . $sublinks;
    }

    /**
     * @return string
     */
    private function contentGenerator(): string
    {
        $page = $this->getCurrentPage();
        $path = "$page.php";

        return sprintf('<iframe src="%s" frameborder="0" class="frame"></iframe>', $path);
    }

    /**
     * @return string
     */
    private function menuGenerator(): string
    {
        $links = [];
        foreach ($this->menu as $menuLink) {
            $links[] = $this->linkGenerator($menuLink);
        }

        return implode('', $links);
    }

    /**
     * @return void
     */
    public function render(): void
    {
        $layout = file_get_contents(dirname(__FILE__) . '/template/layout.html');
        $layout = str_replace('{% yield title %}', $this->title, $layout);
        $layout = str_replace('{% yield menu %}', $this->menuGenerator(), $layout);
        $layout = str_replace('{% yield content %}', $this->contentGenerator(), $layout);

        echo $layout;
    }
}
