<?php namespace Kareem3d\Templating;

use Kareem3d\AssetManager\AssetCollection;

class Page {

    /**
     * @var string
     */
    public $identifier;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Template
     */
    protected $template;

    /**
     * @param $identifier
     * @param $type
     * @param Template $template
     * @return \Kareem3d\Templating\Page
     */
    public function __construct($identifier, $type, Template $template)
    {
        $this->identifier = $identifier;
        $this->type       = $type;
        $this->template  = $template;
    }

    /**
     * @return bool
     */
    public function isDynamic()
    {
        return strtolower($this->type) == 'dynamic';
    }

    /**
     * @return bool
     */
    public function isStatic()
    {
        return strtolower($this->type) == 'static';
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param $args
     */
    public function share( $args )
    {
        $this->template->share($args);
    }

    /**
     * @return \Kareem3d\Templating\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param $_partName
     * @return \Kareem3d\Templating\Part
     */
    public function findPart( $_partName )
    {
        return $this->template->findPart($_partName);
    }

    /**
     * @return AssetCollection[]
     */
    public function getAssetCollections()
    {
        return $this->template->getAssetCollections();
    }

    /**
     * @param Page $page
     * @return bool
     */
    public function same(Page $page)
    {
        return $this->check($page->identifier);
    }

    /**
     * @param $identifier
     * @return bool
     */
    public function check($identifier)
    {
        return $this->identifier == strtolower(trim($identifier));
    }

    /**
     * @param $args
     * @return mixed
     */
    public function printMe(array $args = array())
    {
        return $this->template->printMe($args);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->identifier;
    }
}