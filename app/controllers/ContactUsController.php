<?php 

class ContactUsController extends BaseController {

    /**
     * @var ContactUs
     */
    protected $contactUs;

    /**
     * @param ContactUs $contactUs
     */
    public function __construct(ContactUs $contactUs)
    {
        $this->contactUs = $contactUs;

        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->page()->printMe();
    }

    /**
     * @return mixed
     */
    public function send()
    {
        $contactUs = $this->contactUs->newInstance(Input::get('ContactUs'));

        if(! $contactUs->validate())
        {
            return Redirect::back()->withErrors($contactUs->getValidatorMessages())->withInput();
        }

        Auth::user()->getInfo()->contactUs()->save($contactUs);

        return Redirect::to(URL::page('home'))->with('success', trans('messages.success.contact_us'));
    }

}