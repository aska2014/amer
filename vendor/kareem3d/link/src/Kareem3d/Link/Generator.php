<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Kareem3d\Templating\XMLFactory;

class Generator {

    /**
     * @var LinkRepository
     */
    protected $links;

    /**
     * @var DynamicRouter
     */
    protected $dynamicRouter;

    /**
     * @var \Kareem3d\Templating\XMLFactory
     */
    protected $xmlFactory;

    /**
     * @param \Kareem3d\Link\LinkRepository $links
     * @param XMLFactory $xmlFactory
     */
    public function __construct( LinkRepository $links, XMLFactory $xmlFactory )
    {
        $this->links = $links;
        $this->xmlFactory = $xmlFactory;
    }

    /**
     * @return DynamicRouter
     */
    public function dynamicRouter()
    {
        $currentLink = $this->links->getByUrl(Request::url());

        if($currentLink)
        {
            App::instance('CurrentLink', $currentLink);

            // Push this page to repository
            $this->xmlFactory->pushPageToRepositories($currentLink->getPageName(), $currentLink->getUrl());
        }

        // Return singleton instance of dynamic router giving current link
        return DynamicRouter::instance($currentLink);
    }

}