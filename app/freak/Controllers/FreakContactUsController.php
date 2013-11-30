<?php

use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakContactUsController extends FreakController {

    /**
     * @var ContactUs
     */
    protected $contactUs;

    /**
     * @var ContactUs $contactUs
     */
    public function __construct( ContactUs $contactUs )
    {
        $this->contactUs = $contactUs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $contactUs = $this->contactUs->all();

        return View::make('panel::contactus.data', compact('contactUs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $contactUs = $this->contactUs->find( $id );

        return View::make('panel::contactus.detail', compact('contactUs', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->contactUs->find($id)->delete();

        return Redirect::to(freakUrl('element/contactus'))->with('success', 'Message deleted successfully.');
    }
}