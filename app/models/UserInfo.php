<?php

use Kareem3d\Membership\UserInfo as Kareem3dUserInfo;

class UserInfo extends Kareem3dUserInfo {

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        // Rules for the user information
        $this->rules = array_merge($this->rules, array(

            'first_name' => 'required',
            'contact_email' => 'required',
            'telephone_number' => 'required',
            'mobile_number' => 'required'
        ));
    }
}