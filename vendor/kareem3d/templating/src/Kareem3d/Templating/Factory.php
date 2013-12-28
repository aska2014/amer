<?php namespace Kareem3d\Templating;


interface Factory {

    /**
     * @param $_pageName
     * @param $_pageUrl
     * @return mixed
     */
    public function pushPageToRepositories( $_pageName, $_pageUrl );

    /**
     * @return void
     */
    public function pushToRepositories();
    /**
     * @param $_identifier
     * @return \Kareem3d\Templating\Page
     */
    public function generatePage( $_identifier );

    /**
     * @return Page[]
     */
    public function generatePages();

}