<?php

use Estate\Estate;
use Estate\EstateAlgorithm;
use Estate\EstateCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;
use Special\Special;

class FreakEstateController extends FreakController {

    /**
     * @var Estate
     */
    protected $estates;

    /**
     * @var EstateAlgorithm
     */
    protected $estatesAlgorithm;

    /**
     * @var EstateCategory
     */
    protected $categories;

    /**
     * @var Special
     */
    protected $specials;

    /**
     * @param Estate $estates
     * @param EstateAlgorithm $estatesAlgorithm
     * @param EstateCategory $categories
     * @param Special $specials
     */
    public function __construct( Estate $estates, EstateAlgorithm $estatesAlgorithm, EstateCategory $categories, Special $specials )
    {
        $this->estates = $estates;

        $this->estatesAlgorithm = $estatesAlgorithm;

        $this->categories = $categories;

        $this->specials = $specials;

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
    public function getAccepted()
    {
        Asset::addPlugin('datatables');
        Asset::addPlugin('ibutton');

        $estates = $this->estatesAlgorithm->accepted()->get();

        return View::make('panel::estates.data', compact('estates'));
    }

    /**
     * @return mixed
     */
    public function getNotAccepted()
    {
        Asset::addPlugin('datatables');
        Asset::addPlugin('ibutton');

        $estates = $this->estatesAlgorithm->notAccepted()->get();

        return View::make('panel::estates.data', compact('estates'));
    }

    /**
     * @return mixed
     */
    public function postAcceptMany()
    {
        $accepted = Input::get('Estate.accepted', array());
        $acceptedIds = Input::get('Estate.accepted_ids', array());

        foreach($acceptedIds as $id)
        {
            // Get estate by id
            $estate = $this->estates->find($id);

            isset($accepted[$id]) ? $estate->accept() : $estate->unaccept();
        }

        return Redirect::back()->with('success', 'Estates accepted states updated successfully.');
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
     * @param $id
     */
    public function getMakeSpecial( $id )
    {
        $estate = $this->estates->findOrFail($id);

        return View::make('panel::estates.special', compact('estate'));
    }

    /**
     * @param $id
     */
    public function postMakeSpecial( $id )
    {
        $estate = $this->estates->findOrFail($id);

        $special = $this->specials->newInstance(Input::get('Special'));

        // Make this estate special
        $estate->special()->save($special);

        return Redirect::to(freakUrl('element/estate/show'.$estate->id))->with('success', 'Estate is now special.');
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