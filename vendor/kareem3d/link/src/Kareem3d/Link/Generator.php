<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class Generator {

    /**
     * @return DynamicRouter
     */
    public function dynamicRouter()
    {
        $currentLink = App::make('Kareem3d\Link\LinkRepository')->getByUrl(Request::url());

        App::instance('CurrentLink', $currentLink);

        // Return singleton instance of dynamic router giving current link
        return DynamicRouter::instance($currentLink);
    }

    /**
     * Page xml pages to repository
     *
     * @return void
     */
    public function loadPage()
    {
        if($link = DynamicRouter::instance()->getLink())
        {
            // Push this page to repository
            App::make('Kareem3d\Templating\Factory')->pushPageToRepositories($link->getPageName(), $link->getUrl());
        }
    }
}