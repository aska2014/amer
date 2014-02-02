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
     * @param $id
     */
    public function getSpecial()
    {
        Asset::addPlugin('datatables');
        Asset::addPlugin('ibutton');

        $estates = $this->estatesAlgorithm->specials()->get();

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
     * @param $id
     */
    public function getMakeSpecial( $id )
    {
        Asset::addPlugin('datetime');

        $estate = $this->estates->findOrFail($id);

        $special  = $estate->getActiveSpecial() ?: new \Helper\EmptyClass();

        return View::make('panel::estates.special', compact('estate', 'special'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMakeSpecial( $id )
    {
        $estate = $this->estates->findOrFail($id);

        $from = date('Y-m-d H:i:s', strtotime(Input::get('Special.from')));
        $to = date('Y-m-d H:i:s', strtotime(Input::get('Special.to')));

        dd($from, $to);

        $estate->makeSpecial($from, $to);

        return Redirect::back()->with('success', 'Estate has been made special successfully.');
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