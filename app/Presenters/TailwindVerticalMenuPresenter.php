<?php

namespace App\Presenters;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Nwidart\Menus\MenuItem;
use Nwidart\Menus\Presenters\Presenter;

class TailwindVerticalMenuPresenter extends Presenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return  PHP_EOL . '<aside class="w-56" aria-label="Sidebar">
        <div class="px-3 py-4 overflow-y-auto rounded bg-gray-800">
            <ul class="space-y-2">' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getCloseTagWrapper()
    {
        return  PHP_EOL . '</ul></div></aside>' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li>
                <a ' . $this->getActiveState($item) . ' class="flex items-center p-2 text-base font-normal rounded-lg text-white hover:bg-gray-700" href="' . $item->getUrl() . '">
                ' . $item->icon . '
                <span class="flex-1 ml-3 whitespace-nowrap"> ' . $item->title . '</span></a></li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getActiveState($item)
    {
        return (Request::is($item->getRequest()) || $item->hasActiveOnChild()) ? ' class="flex items-center w-full p-2 text-base font-normal transition duration-75 rounded-lg group text-white bg-gray-700 hover:bg-gray-700"' : null;
    }

    /**
     * {@inheritdoc }
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li><button ' . $this->getActiveState($item) . ' class="flex items-center w-full p-2 text-base font-normal transition duration-75 rounded-lg group text-white hover:bg-gray-700" aria-controls="' . $item->title . '" data-collapse-toggle="' . $item->title . '">
        ' . $item->icon . '
                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">
		        ' . $item->title . '
		        </span>
                <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                        </button>
		        <ul id="' . $item->title . '" class="' . ($item->hasActiveOnChild() ? '' : 'hidden') . ' py-2">
		          ' . $this->getChildMenuItems($item) . '
		        </ul></li>' . PHP_EOL;
    }

    /**
     * Get child menu items.
     *
     * @param \Nwidart\Menus\MenuItem $item
     *
     * @return string
     */
    public function getChildMenuItems(MenuItem $item)
    {
        $results = '';
        foreach ($item->getChilds() as $child) {
            if ($child->hidden()) {
                continue;
            }

            if ($child->hasSubMenu()) {
                $results .= $this->getMultiLevelDropdownWrapper($child);
            } elseif ($child->isHeader()) {
                $results .= $this->getHeaderWrapper($child);
            } elseif ($child->isDivider()) {
                $results .= $this->getDividerWrapper();
            } else {
                $results .= $this->getSubmenu($child, 'ml-2 text-sm');
            }
        }

        return $results;
    }

    /**
     * {@inheritdoc }
     */
    public function getSubmenu($item)
    {
        return '<li>
                <a ' . $this->getActiveStateForSubMenu($item) . ' class="pl-8 flex items-center p-2 text-sm font-normal rounded-lg text-gray-400 hover:bg-gray-700" href="' . $item->getUrl() . '">
                ' . $item->icon . '
                <span class="flex-1 ml-3 whitespace-nowrap"> ' . $item->title . '</span></a></li>';
    }

    public function getActiveStateForSubMenu($item)
    {
        return (Request::is($item->getRequest()) || $item->hasActiveOnChild()) ? ' class="pl-8 flex items-center p-2 text-sm font-bold rounded-lg text-white hover:bg-gray-700"' : null;
    }
}
