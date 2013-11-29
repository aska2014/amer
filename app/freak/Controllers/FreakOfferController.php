<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;
use Special\SpecialOffer;

class FreakOfferController extends FreakController {

    /**
     * @var SpecialOffer
     */
    protected $specialOffers;

    /**
     * @var SpecialOffer $specialOffers
     */
    public function __construct( SpecialOffer $specialOffers )
    {
        $this->specialOffers = $specialOffers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $specialOffers = $this->specialOffers->all();

        return View::make('panel::offers.data', compact('specialOffers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $specialOffer = $this->specialOffers->find( $id );

        $this->setPackagesData($specialOffer);

        return View::make('panel::offers.detail', compact('specialOffer', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $specialOffer = $this->specialOffers;

        $this->setPackagesData($specialOffer);

        return View::make('panel::offers.add', compact('specialOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $specialOffer = $this->specialOffers->find( $id );

        $this->setPackagesData($specialOffer);

        return View::make('panel::offers.add', compact('specialOffer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $specialOffer = $this->specialOffers->findOrNew(Input::get('insert_id'))->fill($this->getInputs());

        $specialOffer->save();

        $this->setModel($specialOffer);

        return $this->jsonModelSuccess();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id)
    {
        $specialOffer = $this->specialOffers->find($id);

        $specialOffer->fill($this->getInputs());

        try{

            return $this->jsonValidateResponse($specialOffer);

        }catch(Exception $e){
            dd(Input::get('SpecialOffer'), $id, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        return Input::get('SpecialOffer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->specialOffers->find($id)->delete();

        return Redirect::to(freakUrl('element/offer'))->with('success', 'Special offer deleted successfully.');
    }
}