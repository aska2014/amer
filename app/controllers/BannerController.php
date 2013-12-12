<?php

class BannerController extends BaseController {

    /**
     * @var Website\BannerPlace
     */
    protected $bannerPlaces;

    /**
     * @var Website\BannerRequest
     */
    protected $bannerRequests;

    /**
     * @param \Website\BannerPlace $bannerPlaces
     * @param Website\BannerRequest $bannerRequests
     */
    public function __construct(\Website\BannerPlace $bannerPlaces, \Website\BannerRequest $bannerRequests)
    {
        $this->bannerPlaces = $bannerPlaces;
        $this->bannerRequests = $bannerRequests;

        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function dynamicRequest()
    {
        $bannerPlaces = $this->bannerPlaces->all();

        return $this->page()->printMe(compact('bannerPlaces'));
    }

    /**
     * @return mixed
     */
    public function postRequest()
    {
        $bannerRequest = $this->bannerRequests->newInstance(Input::get('BannerRequest'));

        $bannerRequest->user()->associate(Auth::user());

        // If not validate then redirect with errors and old inputs
        if(! $bannerRequest->validate())
        {
            return Redirect::back()->withErrors($bannerRequest->getValidatorMessages())->withInput();
        }

        // If valid then save it and redirect with success
        $bannerRequest->save();

        return Redirect::back()->with('success', trans('messages.success.banner_request'));
    }
}