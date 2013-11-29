<?php namespace Estate;

use Kareem3d\Link\Link;

class EstateCategory extends \Kareem3d\Eloquent\Model {

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected $table = 'estate_categories';

    /**
     * @var string
     */
    protected static $specsTable = 'estate_category_specs';

    /**
     * @var array
     */
    protected static $specs = array('title');

    /**
     * @param EstateCategory $except
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function parentCategories( EstateCategory $except = null )
    {
        $query = static::where('parent_id', NULL);

        if($except) $query->where('id', '!=', $except->id);

        return $query->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(EstateCategory::getClass(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(EstateCategory::getClass(), 'parent_id');
    }

    /**
     * @return mixed
     */
    public function estates()
    {
        return $this->hasMany(Estate::getClass());
    }
}