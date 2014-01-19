<?php namespace Kareem3d\Link;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controllers\Controller;

class DynamicController extends Controller {

    /**
     * @param string $method
     * @param array $arguments
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return mixed|void
     */
    public function __call($method, $arguments = array())
    {
        $dynamicMethod = 'dynamic' . ucfirst($method);

        if(method_exists($this, $dynamicMethod))
        {
            $router = DynamicRouter::instance();

            // Fetch model passing the first function argument (if exists)
            if($model = $router->getLink()->getModel(isset($arguments[0]) ? $arguments[0] : false))
            {
                // Replace first argument with the models
                $arguments[0] = $model;

                if(! $model->exists)
                {
                    throw new ModelNotFoundException();
                }
            }

            $router->getLink()->getPage()->share(array(
                'model' => $model
            ));

            return call_user_func_array(array($this, $dynamicMethod), $arguments);
        }

        return parent::__call($method, $arguments);
    }
}