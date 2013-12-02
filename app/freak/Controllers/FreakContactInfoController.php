<?php

use Website\ContactInfo;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Controllers\FreakController;

class FreakContactInfoController extends FreakController {

    /**
     * @var ContactInfo
     */
    protected $contactInfos;

    /**
     * @param Website\ContactInfo $contactInfos
     * @internal param \Estate\ContactInfo $contactInfos
     */
    public function __construct( \Website\ContactInfo $contactInfos )
    {
        $this->contactInfos = $contactInfos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $mobileNumbers = $this->contactInfos->getMobileNumbers(2);

        $email = $this->contactInfos->getMainEmail();

        return View::make('panel::contactInfos.add', compact('mobileNumbers', 'email'));
    }

    /**
     * @return mixed
     */
    public function postIndex()
    {
        $inputs = Input::get('ContactInfo');

        $contactInfos = $this->contactInfos;

        $contactInfos->createOrUpdate($inputs['email'], $contactInfos::EMAIL, 0);

        $contactInfos->createOrUpdate($inputs['mobile_number'][0], $contactInfos::MOBILE_NUMBER, 0, true);

        $contactInfos->createOrUpdate($inputs['mobile_number'][1], $contactInfos::MOBILE_NUMBER, 1);

        return Redirect::back()->with('success', 'Contact information updated successfully');
    }
}