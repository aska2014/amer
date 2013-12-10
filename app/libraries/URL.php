<?php

use \Kareem3d\Link\URL as Kareem3dURL;

class URL extends Kareem3dURL {

    /**
     * @param $uri
     * @return string
     */
    public static function asset( $uri )
    {
        $uri = str_replace('{lan}', App::make('Language')->get(), $uri);

        return parent::asset($uri);
    }

}