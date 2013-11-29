<?php namespace Kareem3d\Link;

use Kareem3d\Eloquent\Model;

class LinkRepository {

    /**
     * @param $array
     */
    public static function addStaticLinks( $array )
    {
        foreach($array as $oneArray)
        {
            $pageName = $oneArray[0];
            $regexUrl = $oneArray[1];
            $modelClass = isset($oneArray[2]) ? $oneArray[2]: null;

            StaticLink::add($pageName, URL::to($regexUrl), $modelClass);
        }
    }

    /**
     * @param $url
     * @return Link
     */
    public static function getByUrl( $url )
    {
        // Search dynamic links first
        if($link = DynamicLink::getByUrl($url)) return $link;

        // Search static links
        return StaticLink::getByUrl($url);
    }

    /**
     * @param $_pageName
     * @return string
     */
    public static function getUrlByPage($_pageName)
    {
        // Search dynamic links first
        if($link = DynamicLink::getUrlByPage($_pageName)) return $link;

        // Search static links
        return StaticLink::getUrlByPage($_pageName);
    }

    /**
     * @param $_pageName
     * @param Model $model
     * @return string
     */
    public static function getUrlByPageAndModel($_pageName, Model $model)
    {
        // Search dynamic links first
        if($link = DynamicLink::getUrlByPageAndModel($_pageName, $model)) return $link;

        // Search static links
        return StaticLink::getUrlByPageAndModel($_pageName, $model);
    }

}