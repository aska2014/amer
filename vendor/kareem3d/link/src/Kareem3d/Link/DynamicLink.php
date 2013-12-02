<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Kareem3d\Eloquent\Model;
use Kareem3d\Templating\Page;

class DynamicLink extends Model implements Link {

    /**
     * @var string
     */
    protected $table = 'ka_links';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dontDuplicate = array('url_id');

    /**
     * @var array
     */
    protected static $temporaryUrls = array();

    protected $i =0;
    /**
     * @return mixed|void
     */
    public function beforeSave()
    {
        if(! isset($this->attributes['url'])) return false;

        // Get url and unset it
        $url = $this->attributes['url']; unset($this->attributes['url']);

        // If this has duplicate page and model then update the duplicate with the url
        if($duplicate = $this->getPageAndModelDuplicate())
        {
            $duplicate->associateUrl($url);

            // If url id isset then update it
            if($duplicate->url_id)
            {
                $this->query()->where('id', $duplicate->id)->update($duplicate->getAttributes());
            }

            // Stop saving this
            return false;
        }

        $this->associateUrl($url);

        if(! $this->url_id) return false;
    }

    /**
     * @return \Kareem3d\Link\DynamicLink
     */
    public function getPageAndModelDuplicate()
    {
        return $this->query()->where('page_name', $this->page_name)
            ->where('linkable_type', $this->linkable_type)
            ->where('linkable_id', $this->linkable_id)
            ->where('id', '!=', $this->id ?: 0)
            ->first();
    }

    /**
     * @param $url
     * @return URL
     */
    public function associateUrl($url)
    {
        $this->url()->associate(App::make('Kareem3d\URL\URL')->create(compact('url')));
    }

    /**
     * @param $_pageName
     * @param \Kareem3d\Eloquent\Model $model
     * @return DynamicLink
     */
    public static function getByPageAndModel($_pageName, Model $model)
    {
        return static::where('page_name', $_pageName)
                    ->where('linkable_type', $model->getClass())
                    ->where('linkable_id', $model->getKey())->first();
    }

    /**
     * @param $url
     * @return DynamicLink
     */
    public static function getByUrl( $url )
    {
        return static::joinUrls()->where('ka_urls.url', $url)->first();
    }

    /**
     * @param $_pageName
     * @param $model
     * @todo Decrease queries by saving url of the linkable
     * @return string
     */
    public static function getUrlByPageAndModel($_pageName, Model $model)
    {
        return static::returnUrl(static::joinUrls()->where('page_name', $_pageName)
                                 ->where('linkable_type', $model->getClass())
                                 ->where('linkable_id', $model->getKey())
                                 ->first(array('url')));
    }

    /**
     * @param $_pageName
     * @return string
     */
    public static function getUrlByPage($_pageName)
    {
        if(empty(static::$temporaryUrls))
        {
            $urlCollection = static::joinUrls()->where('linkable_type', '')->get(array('url', 'page_name'));

            static::$temporaryUrls = $urlCollection->lists('url', 'page_name');
        }

        return isset(static::$temporaryUrls[$_pageName]) ? static::$temporaryUrls[$_pageName] : '';
    }

    /**
     * @param $object
     * @return string
     */
    protected static function returnUrl($object = null)
    {
        return $object ? $object->url : '';
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public static function joinUrls()
    {
        return static::join('ka_urls', 'ka_links.url_id', '=', 'ka_urls.id');
    }

    /**
     * @throws \Exception
     * @return Page
     */
    public function getPage()
    {
        if(! $page = App::make('Kareem3d\Templating\PageRepository')->multiFind(array($this->url, $this->page_name)))
        {
            throw new \Exception('Page defined by this link is incorrect');
        }

        return $page;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return (string) $this->url;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->linkable_type ? $this->linkable : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function url()
    {
        return $this->belongsTo(App::make('Kareem3d\URL\URL')->getClass());
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->page_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function linkable()
    {
        return $this->morphTo();
    }
}