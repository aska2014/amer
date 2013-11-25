<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakNewsController extends FreakController {

    /**
     * @var News
     */
    protected $news;

    /**
     * @var News $news
     */
    public function __construct( News $news )
    {
        $this->news = $news;

        $this->usePackages( 'Image' );

        $this->setExtra(array(
            'image-group-name'  => 'News.Main',
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
        $news = $this->news->get();

        return View::make('panel::news.data', compact('news'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $news = $this->news->find( $id );

        $this->setPackagesData($news);

        return View::make('panel::news.detail', compact('news', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        Asset::addPlugin('ckeditor');

        $news = $this->news;

        $this->setPackagesData($news);

        return View::make('panel::news.add', compact('news'));
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

        $news = $this->news->find( $id );

        $this->setPackagesData($news);

        return View::make('panel::news.add', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $news = $this->news->findOrNew(Input::get('insert_id'))->fill(Input::get('News'));

        $news->save();

        $this->setModel($news);

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
        $news = $this->news->find($id);

        $news->fill(Input::get('News'));

        try{
            return $this->jsonValidateResponse($news);

        }catch(Exception $e){
            dd(Input::get('News'), $id, $e->getMessage());
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
        $this->news->find($id)->delete();

        return Redirect::to(freakUrl('element/news'))->with('success', 'News deleted successfully.');
    }
}