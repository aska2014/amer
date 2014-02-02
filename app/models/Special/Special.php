<?php namespace Special;

use Estate\Estate;

class Special extends \Kareem3d\Eloquent\Model {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estate()
    {
        return $this->belongsTo(Estate::getClass());
    }
}