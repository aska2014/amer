<?php 

class Report extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'reports';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::getClass(), 'user_id');
    }
}