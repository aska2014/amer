<?php

class ServiceCategory extends \Kareem3d\Eloquent\Model {

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected $table = 'service_categories';

    /**
     * @var string
     */
    protected static $specsTable = 'service_category_specs';

    /**
     * @var array
     */
    protected static $specs = array('title');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(ServiceCategory::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(ServiceCategory::getClass());
    }

    /**
     * @return mixed
     */
    public function services()
    {
        return $this->hasMany(Service::getClass());
    }
}