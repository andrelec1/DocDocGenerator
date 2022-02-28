<?php

namespace App;

class MenuLink
{
    private string $name;
    private ?string $path;
    private array $subMenu = [];

    /**
     * @param string $name
     * @param string|null $path
     */
    public function __construct(string $name, string $path = null)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @param MenuLink $subMenu
     * @return $this
     */
    public function addSubLink(MenuLink $subMenu): self
    {
        $this->subMenu[] = $subMenu;

        return $this;
    }

    protected function getInfo(): array
    {
        return [
          'name' => $this->name,
          'path' => $this->path,
          'subLinks' => $this->subMenu,
        ];
    }


}
