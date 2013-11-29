<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;
use Kareem3d\Templating\Page;

class StaticLink implements Link {

    /**
     * @var StaticLink[]
     */
    protected static $links = array();

    /**
     * @var string
     */
    protected $pageName;

    /**
     * @var string
     */
    protected $regexUrl;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @param $_pageName
     * @param $_regex
     * @param null $modelClass
     * @return \Kareem3d\Link\StaticLink
     */
    public function __construct($_pageName, $_regex, $modelClass = null)
    {
        $this->pageName   = $_pageName;
        $this->regexUrl   = $_regex;
        $this->modelClass = $modelClass;
    }

    /**
     * @return string
     */
    public function getModelClass()
    {
        return $this->modelClass;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @return string
     */
    public function getRegexUrl()
    {
        return $this->regexUrl;
    }

    /**
     * @param $url
     * @return bool
     */
    public function matchUrl( $url )
    {
        return preg_match($this->getFormattedRegexUrl(), $url) > 0;
    }

    /**
     * @return string
     */
    public function getFormattedRegexUrl()
    {
        return "#{$this->regexUrl}#";
    }

    /**
     * @param $arguments
     * @return mixed
     */
    public function replaceRegexUrlByArguments($arguments)
    {
        $i = 0;
        $arguments = (array) $arguments;

        return preg_replace_callback('(\(([^\)]+)\))', function() use(&$i, $arguments)
        {
            return isset($arguments[$i]) ? $arguments[$i++] : '{arg'.$i.'}';
        }, $this->regexUrl);
    }

    /**
     * @return string
     */
    public function replaceRegexUrlByFormat()
    {
        $i = 0;

        return preg_replace_callback('(\(([^\)]+)\))', function() use(&$i)
        {
            return '{arg'.++$i.'}';
        }, $this->regexUrl);
    }

    /**
     * @throws \Exception
     * @return Page
     */
    public function getPage()
    {
        if(! $page = App::make('Kareem3d\Templating\PageRepository')->multiFind(array($this->regexUrl, $this->pageName)))
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
        return $this->replaceRegexUrlByFormat();
    }

    /**
     * @param int|bool $id
     * @return Model
     */
    public function getModel( $id = false )
    {
        if($this->getModelClass())
        {
            return App::make($this->getModelClass())->find($id);
        }
    }

    /**
     * @param $_pageName
     * @param $_regex
     * @param $modelClass
     */
    public static function add( $_pageName, $_regex, $modelClass = null )
    {
        static::$links[] = new StaticLink($_pageName, $_regex, $modelClass);
    }

    /**
     * @param $url
     * @return Link
     */
    public static function getByUrl( $url )
    {
        foreach(static::$links as $link)
        {
            if($link->matchUrl($url))
            {
                return $link;
            }
        }
    }

    /**
     * @param $_pageName
     * @param $model
     * @todo Decrease queries by saving url of the linkable
     * @return string
     */
    public static function getUrlByPageAndModel($_pageName, Model $model)
    {
        foreach(static::$links as $link)
        {
            if($link->pageName === $_pageName AND $model->getClass() === $link->modelClass)
            {
                return $link->replaceRegexUrlByArguments($model->id);
            }
        }
    }

    /**
     * @param $_pageName
     * @return \Illuminate\Database\Query\Builder|static
     */
    public static function getUrlByPage($_pageName)
    {
        foreach(static::$links as $link)
        {
            if($link->pageName === $_pageName)
            {
                return $link->regexUrl;
            }
        }
    }

}