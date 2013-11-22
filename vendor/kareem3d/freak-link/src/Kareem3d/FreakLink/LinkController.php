<?php namespace Kareem3d\FreakLink;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;
use Kareem3d\Link\Link;

class LinkController extends FreakController {

    /**
     * @var Link
     */
    protected $links;

    /**
     * @var Link
     */
    public function __construct( Link $links )
    {
        $this->links = $links;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $links = $this->links->get();

        return View::make('freak-link::link.data', compact('links'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $link = $this->links->find( $id );

        return View::make('freak-link::link.detail', compact('id', 'link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $link = $this->links;

        return View::make('freak-link::link.add', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $link = $this->links->findOrFail( $id );

        return View::make('freak-link::link.add', compact('link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $link = $this->links->newInstance( $this->getInputs() );

        return $this->jsonValidateResponse($link);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit($id)
    {
        $link = $this->links->find($id)->fill($this->getInputs());

        return $this->jsonValidateResponse($link);
    }

    /**
     * @return mixed
     */
    protected function getInputs()
    {
        $inputs = Input::get('Link');

        if($inputs['arguments'])
        {
            parse_str($inputs['arguments'], $inputs['arguments']);
        }
        else
        {
            $inputs['arguments'] = array();
        }

        return $inputs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->links->find($id)->delete();

        return Redirect::back()->with('success', 'Deleted successfully.');
    }
}