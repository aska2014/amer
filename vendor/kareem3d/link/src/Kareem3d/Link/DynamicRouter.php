<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DynamicRouter {

    /**
     * @var array
     */
    protected $routes = array();

    /**
     * Link
     *
     * @var Link
     */
    protected $link;

    /**
     * @var DynamicRouter
     */
    protected static $instance;

    /**
     * @param Link $link
     */
    private function __construct(Link $link = null)
    {
        $this->link = $link;
    }

    /**
     * @param Link $link
     * @return DynamicRouter
     */
    public static function instance(Link $link = null)
    {
        if(! static::$instance)
        {
            static::$instance = new static($link);
        }

        return static::$instance;
    }

    /**
     * @param  Link $link
     * @return void
     */
    public function setCurrentLink(Link $link)
    {
        $this->link = $link;
    }

    /**
     * @return \Kareem3d\Link\Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Launch the Dynamic route class
     */
    public function launch()
    {
        // If current link is defined and there's a page linking to it...
        if($link = $this->getLink())
        {
            $path = str_replace(URL::to(''), '', $link->getUrl());

            // If it has controller route to the controller route
            if($controller = $this->getController())
            {
                Route::get($path, $controller . '@route');
            }

            else
            {
                Route::get($path, function() use($link)
                {
                    $arguments = func_get_args();

                    // Fetch model passing the first function argument (if exists)
                    if($model = $this->getLink()->getModel(isset($arguments[0]) ? $arguments[0] : false))
                    {
                        // Replace first argument with the models
                        $arguments[0] = $model;
                    }

                    return $link->getPage()->printMe(array(
                        'model' => $model
                    ));
                });
            }
        }
    }

    /**
     * @return $this
     */
    protected function getControllerActionString()
    {
        list($controller, $action) = $this->getControllerAndAction();

        return $controller . '@' . $action;
    }

    /**
     * @return string
     */
    public function getController()
    {
        list($controller) = $this->getControllerAndAction();

        // If controller exists and is subclass of the dynamic controller
        return (class_exists($controller) AND is_subclass_of($controller, 'Kareem3d\Link\DynamicController')) ? $controller : null;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        list(, $action) = $this->getControllerAndAction();

        return $action;
    }


    /**
     * @return array
     */
    public function getControllerAndAction()
    {
        $pageName = $this->getLink()->getPageName();

        $parts = explode('/', $pageName);

        if(count($parts) > 1)
        {
            return array(ucfirst(Str::camel($parts[0])) . 'Controller',  Str::camel($parts[1]));
        }

        return array(ucfirst(Str::camel($parts[0])) . 'Controller', 'index');
    }
}