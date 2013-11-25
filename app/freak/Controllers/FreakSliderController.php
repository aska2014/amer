<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakSliderController extends FreakController {

    /**
     * @var Slider
     */
    protected $sliders;

    /**
     * @var Slider $sliders
     */
    public function __construct( Slider $sliders )
    {
        $this->sliders = $sliders;

        $this->usePackages( 'Image' );

        $this->setExtra(array(
            'image-group-name'  => 'Slider.Main',
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
        $sliders = $this->sliders->get();

        return View::make('panel::sliders.data', compact('sliders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $slider = $this->sliders->find( $id );

        $this->setPackagesData($slider);

        return View::make('panel::sliders.detail', compact('slider', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        Asset::addPlugin('ckeditor');

        $slider = $this->sliders;

        $this->setPackagesData($slider);

        return View::make('panel::sliders.add', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        Asset::addPlugin('ckeditor');

        $slider = $this->sliders->find( $id );

        $this->setPackagesData($slider);

        return View::make('panel::sliders.add', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $slider = $this->sliders->findOrNew(Input::get('insert_id'))->fill(Input::get('Slider'));

        $slider->save();

        $this->setModel($slider);

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
        $slider = $this->sliders->find($id);

        $slider->fill(Input::get('Slider'));

        try{
            return $this->jsonValidateResponse($slider);

        }catch(Exception $e){
            dd(Input::get('Slider'), $id, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->sliders->find($id)->delete();

        return Redirect::to(freakUrl('element/slider'))->with('success', 'Slider deleted successfully.');
    }
}