<?php namespace Kareem3d\Freak\Core;

use Illuminate\Support\Facades\Response;

abstract class Package implements PackageInterface {

    /**
     * @var PackageData[]
     */
    protected $data = array();

    /**
     * @param $name
     * @return bool|string
     */
    public function checkName( $name )
    {
        return strtolower($this->getName()) === strtolower($name);
    }

    /**
     * @param PackageData $data
     */
    public function addData(PackageData $data)
    {
        $this->data[] = $data;
    }

    /**
     * @param PackageData[] $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return PackageData|null
     */
    protected function getElementData()
    {
        foreach($this->data as $packageData)
        {
            if($packageData->fromElement())

                return $packageData;
        }
    }

    /**
     * @param $package
     * @return PackageData
     */
    protected function getPackageData( $package )
    {
        foreach($this->data as $packageData)
        {
            if($packageData->fromPackage($package))

                return $packageData;
        }
    }

    /**
     * @param $key
     * @param string $default
     * @return string
     */
    protected function getExtra( $key, $default = '' )
    {
        $extra = null;

        foreach($this->data as $packageData)
        {
            // Not breaking the loop after finding the extra to allow for packages override the extra!
            if($packageData->hasExtra($key))

                $extra = $packageData->getExtra($key);
        }

        return $extra ?: $default;
    }

    /**
     * @param $key
     * @return string
     * @throws \Exception
     */
    protected function getExtraRequired( $key )
    {
        if(! $value = $this->getExtra( $key ))

            throw new \Exception("The extra {$key} is required for {$this->getName()} package");

        return $value;
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonError(array $data = array())
    {
        return Response::json(array(
            'status' => 'fail',
            'data'   => $data
        ));
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonSuccess(array $data = array())
    {
        return Response::json(array(
            'status' => 'success',
            'data' => $data
        ));
    }
}