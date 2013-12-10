<?php namespace Place;

class Province extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'provinces';

    /**
     * @var string
     */
    protected static $specsTable = 'provinces_specs';

    /**
     * @var array
     */
    protected static $specs = array( 'name' );

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estates()
    {
        return $this->hasMany(\Estate\Estate::getClass());
    }
}