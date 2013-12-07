<?php namespace Kareem3d\Marketing;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Kareem3d\Eloquent\Model;
use Kareem3d\Link\Link;
use Kareem3d\URL\URL;

class SEO extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ka_seo';

    /**
     * @var array
     */
    protected $dontDuplicate = array('url_id');

    /**
     * @param $value
     * @return mixed
     */
    public function setUrlAttribute( $value )
    {
        // If it's an instance of url then save it
        if(App::make('Kareem3d\URL\URL')->sameClass($value))
        {
            return $this->url()->save($value);
        }

        else
        {
            return $this->url()->associate(App::make('Kareem3d\URL\URL')->create(array('url' => $value)));
        }
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        return View::make('marketing::head', array('seo' => $this))->render();
    }

    /**
     * @param $inputs
     * @return SEO|null
     */
    public static function createOrUpdate( $inputs )
    {
        if(! isset($inputs['url_id'])) return null;

        if($seo = static::getByUrlId($inputs['url_id']))
        {
            $seo->update($inputs);

            return $seo;
        }
        else
        {
            return static::create($inputs);
        }
    }

    /**
     * @param \Kareem3d\URL\URL $url
     * @return SEO
     */
    public static function getByUrl( $url )
    {
        // If it's an instance of url
        if(App::make('Kareem3d\URL\URL')->sameClass($url))
        {
            return static::getByUrlId($url->id);
        }

        else
        {
            return static::join('ka_urls', 'ka_urls.id', '=', 'ka_seo.url_id')
                    ->select(array('ka_seo.*'))
                    // Search by trimmed and by non trimmed
                    ->where('ka_urls.url', trim($url, '/'))
                    ->orWhere('ka_urls.url', trim($url, '/') . '/')
                    ->first();
        }
    }

    /**
     * @param $id
     * @return SEO
     */
    public static function getByUrlId( $id )
    {
        return static::where('url_id', $id)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function url()
    {
        return $this->belongsTo(App::make('Kareem3d\URL\URL')->getClass());
    }
}