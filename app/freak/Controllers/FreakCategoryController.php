<?php

use Estate\EstateCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakCategoryController extends FreakController {

    /**
     * @var EstateCategory
     */
    protected $categories;

    /**
     * @var EstateCategory $categories
     */
    public function __construct( EstateCategory $categories )
    {
        $this->categories = $categories;

        $this->usePackages( 'Image', 'Link' );

        $this->setExtra(array(
            'image-group-name'  => 'EstateCategory.Main',
            'image-type'        => 'main',
            'link-page'         => 'estate/all'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $categories = $this->categories->parentCategories();

        return View::make('panel::categories.data', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $category = $this->categories->find( $id );

        $this->setPackagesData($category);

        return View::make('panel::categories.detail', compact('category', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $category = $this->categories;

        $estateCategories = $this->categories->parentCategories();

        $this->setPackagesData($category);

        return View::make('panel::categories.add', compact('category', 'estateCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $category = $this->categories->find( $id );

        $estateCategories = $this->categories->parentCategories($category);

        $this->setPackagesData($category);

        return View::make('panel::categories.add', compact('category', 'estateCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $category = $this->categories->findOrNew(Input::get('insert_id'))->fill($this->getInputs());

        $category->save();

        $this->setModel($category);

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
        $category = $this->categories->find($id);

        $category->fill($this->getInputs());

        try{

            return $this->jsonValidateResponse($category);

        }catch(Exception $e){
            dd(Input::get('Category'), $id, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    protected function getInputs()
    {
        $categoryInputs = Input::get('Category');

        if(isset($categoryInputs['parent_id']) && ! $categoryInputs['parent_id'])
        {
            $categoryInputs['parent_id'] = NULL;
        }

        return $categoryInputs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->categories->find($id)->delete();

        return Redirect::to(freakUrl('element/category'))->with('success', 'Estate category deleted successfully.');
    }
}