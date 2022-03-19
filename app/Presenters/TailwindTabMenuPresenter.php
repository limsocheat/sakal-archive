<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Request;
use Nwidart\Menus\Presenters\Presenter;

class TailwindTabMenuPresenter extends Presenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return  PHP_EOL . '<div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px">' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getCloseTagWrapper()
    {
        return  PHP_EOL . '</ul>
        </div>' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li class="mr-2"><a ' . $this->getActiveState($item) . ' class="inline-flex py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 group" href="' . $item->getUrl() . '">' . $item->icon . ' ' . $item->title . '</a></li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getActiveState($item)
    {
        return Request::is($item->getRequest()) ? ' class="inline-flex py-4 px-4 text-sm font-medium text-center text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group"' : null;
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
        return '<li class="has-dropdown">
		        <a href="#">
		         ' . $item->icon . ' ' . $item->title . '
		        </a>
		        <ul class="dropdown">
		          ' . $this->getChildMenuItems($item) . '
		        </ul>
		      </li>' . PHP_EOL;;
    }
}
