<?php namespace Kareem3d\Templating;

use Kareem3d\AssetManager\Asset;
use Kareem3d\AssetManager\AssetCollection;

class ArrayFactory implements Factory {

    /**
     * @var array
     */
    protected $pagesArray;

    /**
     * @var array
     */
    protected $assetsArray;

    /**
     * @var ArrayFactory
     */
    protected static $instance;

    /**
     * @param $pagesArrayFile
     * @param $assetsArrayFile
     */
    private function __construct($pagesArrayFile, $assetsArrayFile)
    {
        $this->pagesArray = include($pagesArrayFile);
        $this->assetsArray = include($assetsArrayFile);
    }

    /**
     * @param array $pagesArray
     * @param array $assetsArray
     * @return ArrayFactory
     */
    public static function instance($pagesArray = array(), $assetsArray = array())
    {
        static::$instance = static::$instance ?: new ArrayFactory($pagesArray, $assetsArray);

        return static::$instance;
    }


    /**
     * @param $_pageName
     * @param $_pageUrl
     * @return mixed
     */
    public function pushPageToRepositories($_pageName, $_pageUrl)
    {
        if(isset($this->pagesArray[$_pageUrl]))
        {
            $page = $this->generatePage($_pageUrl);
        }
        elseif(isset($this->pagesArray[$_pageName]))
        {
            $page = $this->generatePage($_pageName);
        }
        else
        {
            return null;
        }

        PageRepository::add($page);

        return $page;
    }

    /**
     * @return void
     */
    public function pushToRepositories()
    {
        PageRepository::put($this->generatePages());
    }

    /**
     * @param $_identifier
     * @return \Kareem3d\Templating\Page
     */
    public function generatePage( $_identifier )
    {
        return new Page($_identifier, 'static', $this->generateTemplate($this->pagesArray[$_identifier]));
    }

    /**
     * @return Page[]
     */
    public function generatePages()
    {
        $pages = array();

        foreach($this->pagesArray as $identifier => $_)
        {
            $pages[] = $this->generatePage($identifier);
        }

        return $pages;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getDefault( $key = '' )
    {
        if($this->hasDefault())
        {
            return $key ? $this->pagesArray['default'][$key] : $this->pagesArray['default'];
        }
    }

    /**
     * @return bool
     */
    public function hasDefault()
    {
        return isset($this->pagesArray['default']);
    }

    /**
     * @return Location[]
     */
    public function getDefaultLocations()
    {
        return $this->generateLocations($this->getDefault());
    }

    /**
     * @return array
     */
    public function getDefaultTemplate()
    {
        if($this->hasDefault())
        {
            return $this->getDefault('template');
        }
    }

    /**
     * @param $pageArray
     * @return Template
     */
    public function generateTemplate( $pageArray )
    {
        $locations    = $this->generateLocations($pageArray);
        $templateName = isset($pageArray['template']) ? $pageArray['template'] : '';

        // Merge default with the current configurations
        if($this->hasDefault())
        {
            $locations    = array_merge($this->getDefaultLocations(), $locations);
            $templateName = $templateName ?: $this->getDefaultTemplate();
        }

        return new Template($templateName, $locations, $this->generateAssetCollectionForTemplate( $templateName ));
    }

    /**
     * @param $pageArray
     * @return Location[]
     */
    protected function generateLocations($pageArray)
    {
        $locations = array();

        foreach($pageArray as $key => $value)
        {
            if($key == 'template') continue;

            // Create new location
            $location = new Location(trim($key));

            // Parts are separated by `|` in the array
            $partsPieces = explode('|', $value);

            foreach($partsPieces as $partName)
            {
                $partName = trim($partName);

                if($partName == '') continue;

                $part = new Part($partName, $this->generateAssetCollectionForPart($partName));

                $location->addPart($part);

                PartRepository::add($part);
            }

            // Using key to prevent duplication...
            $locations[$key] = $location;
        }

        return $locations;
    }

    /**
     * @param $partName
     * @return AssetCollection
     */
    protected function generateAssetCollectionForPart($partName)
    {
        foreach($this->assetsArray as $assetCollection)
        {
            if(isset($assetCollection['part']) && $assetCollection['part'] == $partName)
            {
                unset($assetCollection['part']);

                return new AssetCollection($this->generateAssets( $assetCollection ));
            }
        }
    }

    /**
     * @param $templateName
     * @return AssetCollection
     */
    protected function generateAssetCollectionForTemplate($templateName)
    {
        foreach($this->assetsArray as $assetCollection)
        {
            if(isset($assetCollection['template']) && $assetCollection['template'] == $templateName)
            {
                unset($assetCollection['template']);

                return new AssetCollection($this->generateAssets( $assetCollection ));
            }
        }
    }

    /**
     * @param $assetCollection
     * @return Asset[]
     */
    protected function generateAssets(array $assetCollection)
    {
        $assets = array();

        foreach($assetCollection as $type => $assetPaths)
        {
            foreach((array) $assetPaths as $assetPath)
            {
                $assets[] = new Asset(trim($assetPath), strtolower(trim($type)));
            }
        }

        return $assets;
    }
}