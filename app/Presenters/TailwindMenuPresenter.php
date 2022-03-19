<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Request;
use Nwidart\Menus\Presenters\Presenter;

class TailwindMenuPresenter extends Presenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return  PHP_EOL . '' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getCloseTagWrapper()
    {
        return  PHP_EOL . '' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<a ' . $this->getActiveState($item) . ' class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition" href="' . $item->getUrl() . '">' . $item->getIcon() . ' ' . $item->title . '</a>';
    }

    /**
     * {@inheritdoc }
     */
    public function getActiveState($item)
    {
        return Request::is($item->getRequest()) ? ' class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition"' : null;
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
		         ' . $item->getIcon() . ' ' . $item->title . '
		        </a>
		        <ul class="dropdown">
		          ' . $this->getChildMenuItems($item) . '
		        </ul>
		      </li>' . PHP_EOL;;
    }
}
