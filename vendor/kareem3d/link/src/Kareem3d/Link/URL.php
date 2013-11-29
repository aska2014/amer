<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;

use Illuminate\Support\Facades\URL as LaravelURL;

class URL extends LaravelURL {

    /**
     * @var
     */
    protected static $temporaryUrls;

    /**
     * @param $_pageName
     * @param Model $model
     * @return mixed
     */
    public static function page( $_pageName, $model = null )
    {
        /**
         * @param \Kareem3d\Link\LinkRepository $link
         */
        $link = App::make('Kareem3d\Link\LinkRepository');

        if($model == null)
        {
            $url = $link->getUrlByPage($_pageName);
        }

        else
        {
            $url = $link->getUrlByPageAndModel($_pageName, $model);
        }

        return $url ?: '#';
    }
}