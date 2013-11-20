<?php namespace Kareem3d\AssetManager;

class AssetCollection {

    /**
     * @var Asset[]
     */
    protected $assets;

    /**
     * @param Asset[] $assets
     * @return \Kareem3d\AssetManager\AssetCollection
     */
    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    /**
     * @param $type
     * @return string
     */
    public function printType( $type )
    {
        $string = '';

        foreach($this->assets as $asset)
        {
            if($asset->is($type))
            {
                $string .= $asset->printMe() . PHP_EOL;
            }
        }

        return $string;
    }

    /**
     * @return string
     */
    public function printAll()
    {
        $string = '';

        foreach($this->assets as $asset)
        {
            $string .= $asset->printMe() . PHP_EOL;
        }

        return $string;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->printAll();
    }
}