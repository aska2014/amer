<?php

use Website\Banner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakBannerController extends FreakController {

    /**
     * @var Banner
     */
    protected $banners;

    /**
     * @var Website\BannerPlace
     */
    protected $bannerPlaces;

    /**
     * @param Banner $banners
     * @param Website\BannerPlace $bannerPlaces
     */
    public function __construct( Banner $banners, \Website\BannerPlace $bannerPlaces )
    {
        $this->banners = $banners;
        $this->bannerPlaces = $bannerPlaces;

        $this->usePackages( 'Image' );

        $this->setExtra(array(
            'image-group-name'  => 'Banner.Main',
            'image-type'        => 'main',
            'image-name'        => 'banner'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $banners = $this->banners->get();

        return View::make('panel::banners.data', compact('banners'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $banner = $this->banners->find( $id );

        $this->setPackagesData($banner);

        return View::make('panel::banners.detail', compact('banner', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        Asset::addPlugin('datetime');

        $banner = $this->banners;

        $bannerPlaces = $this->bannerPlaces->all();

        $this->setPackagesData($banner);

        return View::make('panel::banners.add', compact('banner', 'bannerPlaces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $banner = $this->banners->find( $id );

        $bannerPlaces = $this->bannerPlaces->all();

        $this->setPackagesData($banner);

        return View::make('panel::banners.add', compact('banner', 'bannerPlaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $banner = $this->banners->findOrNew(Input::get('insert_id'))->fill($this->getInputs());

        return $this->jsonValidateResponse($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id)
    {
        $banner = $this->banners->find($id);

        $banner->fill($this->getInputs());

        try{

            return $this->jsonValidateResponse($banner);

        }catch(Exception $e){
            dd(Input::get('Banner'), $id, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        $bannerInputs = Input::get('Banner');

        $bannerInputs['from'] = date('Y-m-d H:i:s', strtotime($bannerInputs['from']));
        $bannerInputs['to'] = date('Y-m-d H:i:s', strtotime($bannerInputs['to']));

        return $bannerInputs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->banners->find($id)->delete();

        return Redirect::to(freakUrl('element/banner'))->with('success', 'Website banner deleted successfully.');
    }
}