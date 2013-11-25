<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakEstateController extends FreakController {

    /**
     * @var Estate
     */
    protected $estates;

    /**
     * @var EstateCategory
     */
    protected $categories;

    /**
     * @param Estate $estates
     * @param EstateCategory $categories
     */
    public function __construct( Estate $estates, EstateCategory $categories )
    {
        $this->estates = $estates;

        $this->categories = $categories;

        $this->usePackages( 'Images', 'Image' );

        $this->setExtra(array(
            'images-group-name' => 'Estate.Gallery',
            'images-type'       => 'gallery',
            'image-group-name'  => 'Estate.Main',
            'image-type'        => 'main',
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        Asset::addPlugin('datatables');
        Asset::addPlugin('ibutton');

        $estates = $this->estates->get();

        return View::make('panel::estates.data', compact('estates'));
    }

    /**
     * @return mixed
     */
    public function postMakeSpecial()
    {
        $specials = Input::get('Estate.special', array());
        $specialIds = Input::get('Estate.special_ids', array());

        foreach($specialIds as $id)
        {
            // Get estate by id
            $estate = $this->estates->find($id);

            // Make special
            $estate->special = isset($specials[$id]);

            // Save to database
            $estate->save();
        }

        return Redirect::back()->with('success', 'Estates special updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $estate = $this->estates->find( $id );

        $this->setPackagesData($estate);

        return View::make('panel::estates.detail', compact('estate', 'id'));
    }

    /**
     * Show the add for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return Redirect::to(freakUrl('element/estate'));
        Asset::addPlugin('ckeditor');

        $estate = $this->estates;

        $this->setPackagesData($estate);

        $categories = $this->categories->all();

        return View::make('panel::estates.add', compact('estate', 'categories'));
    }

    /**
     * Show the add for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        return Redirect::to(freakUrl('element/estate/show/' . $id));
        $estate = $this->estates->find( $id );

        $this->setPackagesData($estate);

        return $this->getCreate()->with('estate', $estate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        // Find or get new instance of the estate
        $estate = $this->estates->findOrNew(Input::get('insert_id'))->fill(Input::get('Estate'));

        $this->setImageSEO( $estate );

        return $this->jsonValidateResponse( $estate );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id)
    {
        $estate = $this->estates->find($id)->fill(Input::get('Estate'));

        $this->setImageSEO( $estate );

        return $this->jsonValidateResponse( $estate );
    }

    /**
     * @param Estate $estate
     */
    protected function setImageSEO( Estate $estate )
    {
        $this->addExtra('image-title', $estate->en('title'));
        $this->addExtra('image-alt', $estate->en('title'));
        $this->addExtra('images-title', $estate->en('title'));
        $this->addExtra('images-alt'  , $estate->en('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->estates->find($id)->delete();

        return Redirect::to(freakUrl('element/estate'))->with('success', 'Estate deleted successfully.');
    }
}