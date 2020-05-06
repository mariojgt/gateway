<?php

namespace mariojgt\checkout\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class Menu
{

    public $items;
    protected $current;
    protected $currentKey;

    public function __construct()
    {
        $this->current = Request::url();
        $this->items   = [];
    }

    /*
     * Shortcut method for create a menu with a callback.
     * This will allow you to do things like fire an even on creation.
     *
     * @param callable $callback Callback to use after the menu creation
     * @return object
     */
    public static function create($callback)
    {
        $menu = new Menu();
        $callback($menu);
        // $menu->sortItems();

        return $menu;
    }

    public function add($menu = array())
    {

        // $this->items[$menu['position'].'-'.$menu['section']] = $menu['menu'];
        $this->items[$menu['position']][$menu['section']][] = $menu['menu'];
    }

    public function render($items = null, $level = 1)
    {
        ksort($this->items, true);
        foreach ($this->items as $position => $groups) {
            foreach ($groups as $groupLabel => $items) {
                echo '<ul class="menu'.($groupLabel != '' ? ' with-label" data-title="'.$groupLabel : false).'">';
                foreach ($items as $item) {
                    self::buildItem($item);
                }
                echo '</ul>';
            }
        }
    }

    public function buildItem($item)
    {
        ob_start();
        $url      = isset($item['url']) ? $item['url'] : '#';
        $isParent = isset($item['menu']);
        ?>
        <li>
            <a href="<?= $url; ?>" title="<?= $item['text']; ?>" class="<?= $isParent ? 'sm-toggle' : false; ?>">
                <i class="<?= $item['icon']; ?>"></i>
                <?= $item['text']; ?>
            </a>
            <?php if ($isParent) { ?>
                <ul class="submenu">
                    <?php foreach ($item['menu'] as $subItem) { ?>
                        <?php
                        $subUrl = isset($subItem['url']) ? $subItem['url'] : '#';
                        ?>
                        <li><a href="<?= $subUrl; ?>"><?= $subItem['text']; ?></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
        <?php
        echo ob_get_clean();
    }

    /*
     * Method to find the active links
     *
     * @param array $item Item that needs to be checked if active
     * @return string
    */
    private function getActive($item)
    {
        $url = trim($item['url'], '/');

        if ($this->current === $url) {
            return 'active current';
        }

        if (strpos($this->currentKey, $item['key']) === 0) {
            return 'active';
        }
    }
}
