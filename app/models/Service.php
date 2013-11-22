<?php

class Service extends \Kareem3d\Eloquent\Model {

    const FOR_SALE = 0;
    const FOR_RENT = 0;
    const FOR_BUY = 0;
    const AUCTION = 0;

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected static $specsTable = 'service_specs';

    /**
     * @var array
     */
    protected static $specs = array(  );

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUser()
    {
        return User::getByCreation( $this )->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ServiceCategory::getClass());
    }
}