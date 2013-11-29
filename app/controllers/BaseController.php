<?php

use Illuminate\Support\MessageBag;

class BaseController extends \Kareem3d\Link\DynamicController {

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * @return bool
     */
    public function emptyErrors()
    {
        return !$this->errors || $this->errors->isEmpty();
    }

    /**
     * @param $errors
     */
    public function addErrors( $errors )
    {
        if(! $errors) return;

        $errors = $errors instanceof MessageBag ? $errors->toArray() : $errors;

        $this->errors = $this->errors ? $this->errors->merge($errors) : new MessageBag($errors);
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    /**
     * @return \Kareem3d\Link\Link
     */
    public function link()
    {
        return App::make('CurrentLink');
    }

    /**
     * @return \Kareem3d\Templating\Page
     */
    public function page()
    {
        return $this->link()->getPage();
    }
}