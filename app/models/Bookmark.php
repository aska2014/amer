<?php

use Estate\Estate;

class Bookmark extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'bookmarks';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param User $user
     * @param Estate $estate
     * @return Bookmark|null
     */
    public static function add(User $user, Estate $estate)
    {
        $user_id = $user->id;
        $estate_id = $estate->id;

        $exists = static::where('user_id', $user_id)->where('estate_id', $estate_id)->count() > 0;

        if(! $exists)
        {
            return static::create(compact('user_id', 'estate_id'));
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estate()
    {
        return $this->belongsTo(\Estate\Estate::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::getClass());
    }

}