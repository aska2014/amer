<?php namespace Kareem3d\Link;

use Illuminate\Routing\Controllers\Controller;

class DynamicController extends Controller {

    /**
     * @return mixed
     */
    public function route()
    {
        $router = DynamicRouter::instance();

        $arguments = func_get_args();

        // Fetch model passing the first function argument (if exists)
        if($model = $router->getLink()->getModel(isset($arguments[0]) ? $arguments[0] : false))
        {
            // Replace first argument with the models
            $arguments[0] = $model;
        }

        $router->getLink()->getPage()->share(array(
            'model' => $model
        ));

        return call_user_func_array(array($this, $router->getAction()), $arguments);
    }

}