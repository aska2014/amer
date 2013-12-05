<?php

use Website\BannerRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakBannerRequestController extends FreakController {

    /**
     * @var BannerRequest
     */
    protected $bannerRequests;

    /**
     * @var BannerRequest $bannerRequests
     */
    public function __construct( BannerRequest $bannerRequests )
    {
        $this->bannerRequests = $bannerRequests;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $bannerRequests = $this->bannerRequests->all();

        return View::make('panel::bannerRequests.data', compact('bannerRequests'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $bannerRequest = $this->bannerRequests->find( $id );

        $this->setPackagesData($bannerRequest);

        return View::make('panel::bannerRequests.detail', compact('bannerRequest', 'id'));
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        $bannerRequestInputs = Input::get('BannerRequest');

        return $bannerRequestInputs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->bannerRequests->find($id)->delete();

        return Redirect::to(freakUrl('element/bannerRequest'))->with('success', 'Estate bannerRequest deleted successfully.');
    }
}