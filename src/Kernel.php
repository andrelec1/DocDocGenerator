<?php

namespace App;

class Kernel
{
    /** @var array|string[] */
    private array $menu = [];

    /** @var string  */
    private string $title = '';

    /**
     * @param array $menu
     * @return void
     */
    public function loadMenu(array $menu): void
    {
        $this->menu = $menu;
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
     */
    private function linkGenerator(string $text, string $path): string
    {
        if ($path === $this->getCurrentPage()) {
            return sprintf('<a href="?page=%s" class="active">%s</a>',$path, $text);
        }

        return sprintf('<a href="?page=%s">%s</a>',$path, $text);
    }

    /**
     * @return string
     */
    private function contentGenerator(): string
    {
        $page = $this->getCurrentPage();
        $path = "Pages/$page.php";

        return sprintf('<iframe src="%s" frameborder="0" class="frame"></iframe>', $path);
    }

    /**
     * @return string
     */
    private function menuGenerator(): string
    {
        $links = [];
        foreach ($this->menu as $title => $path) {
            $links[] = $this->linkGenerator($title, $path);
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
