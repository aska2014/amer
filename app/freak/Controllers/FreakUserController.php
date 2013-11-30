<?php

use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakUserController extends FreakController {

    /**
     * @var User
     */
    protected $users;

    /**
     * @var UserInfo
     */
    protected $usersInfo;

    /**
     * @param User $users
     * @param UserInfo $usersInfo
     */
    public function __construct( User $users, UserInfo $usersInfo )
    {
        $this->users = $users;
        $this->usersInfo = $usersInfo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $users = $this->users->all();

        return View::make('panel::users.data', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        $user = $this->users->find( $id );

        return View::make('panel::users.detail', compact('user', 'id'));
    }

    /**
     * @param $id
     */
    public function getShowInfo($id)
    {
        $userInfo = $this->usersInfo->find( $id );

        return View::make('panel::userinfo.detail', compact('userInfo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $this->users->find($id)->delete();

        return Redirect::to(freakUrl('element/users'))->with('success', 'User deleted successfully.');
    }
}