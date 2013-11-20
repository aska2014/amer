<?php namespace Kareem3d\AssetManager;

use Illuminate\Support\Facades\URL;

class Asset {

    const JAVASCRIPT = 'js';
    const CSS = 'css';

    /**
     * @var string
     */
    protected $path;

    /**
     * @var integer
     */
    protected $type;

    /**
     * @var array
     */
    protected $extra;

    /**
     * @param $path
     * @param $type
     * @param array $extra
     */
    public function __construct($path, $type, $extra = array())
    {
        $this->path = $path;
        $this->type = $type;
        $this->extra = $extra;
    }

    /**
     * @param $type
     * @return bool
     */
    public function is($type)
    {
        return $this->type == $type;
    }

    /**
     * @return bool
     */
    public function isJs()
    {
        return $this->is(static::JAVASCRIPT);
    }

    /**
     * @return bool
     */
    public function isCss()
    {
        return $this->is(static::CSS);
    }

    /**
     * @return string
     */
    public function printMe()
    {
        if($this->type == static::JAVASCRIPT)
        {
            return "<script type='text/javascript' src='{$this->getUrl()}' {$this->getExtraString()}></script>";
        }

        elseif($this->type == static::CSS)
        {
            return "<link rel='stylesheet' href='{$this->getUrl()}' {$this->getExtraString()}>";
        }
    }

    /**
     * @return string
     */
    public function getExtraString()
    {
        $string = '';

        foreach($this->extra as $key => $value)
        {
            $string .= "$key='$value'";
        }

        return $string;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        // If not url then return the full url to assets
        if(! $this->isUrl())
        {
            return URL::to($this->path);
        }

        return $this->path;
    }

    /**
     * Check if this is a valid url.
     *
     * @return boolean
     */
    public function isUrl()
    {
        return strpos($this->path, '//') > -1 || filter_var($this->path, FILTER_VALIDATE_URL);
    }
}