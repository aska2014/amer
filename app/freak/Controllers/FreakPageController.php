<?php

use Website\Page;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakPageController extends FreakController {

    /**
     * @var Page
     */
    protected $pages;

    /**
     * @var Page $pages
     */
    public function __construct( Page $pages )
    {
        $this->pages = $pages;

        $this->usePackages( 'Link' );

        $this->setExtra(array(
            'link-page' => 'page'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $pages = $this->pages->all();

        return View::make('panel::pages.data', compact('pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $page = $this->pages->find( $id );

        $this->setPackagesData($page);

        return View::make('panel::pages.detail', compact('page', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        Asset::addPlugin('ckeditor');

        $page = $this->pages;

        $this->setPackagesData($page);

        return View::make('panel::pages.add', compact('page'));
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

        $page = $this->pages->find( $id );

        $this->setPackagesData($page);

        return View::make('panel::pages.add', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $page = $this->pages->findOrNew(Input::get('insert_id'))->fill($this->getInputs());

        $page->save();

        $this->setModel($page);

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
        $page = $this->pages->find($id);

        $page->fill($this->getInputs());

        try{

            return $this->jsonValidateResponse($page);

        }catch(Exception $e){
            dd(Input::get('Page'), $id, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        $pageInputs = Input::get('Page');

        return $pageInputs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->pages->find($id)->delete();

        return Redirect::to(freakUrl('element/page'))->with('success', 'Website page deleted successfully.');
    }
}