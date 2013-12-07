<?php

use Kareem3d\Eloquent\Model;

class Comment extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $rules = array(
        'body' => 'required',
        'user_id' => 'required|exists:ka_user_accounts,id',
        'commentable_type' => 'required'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(App::make('Kareem3d\Membership\User')->getClass());
    }

    /**
     * @param Model $model
     */
    public function attachTo( Model $model )
    {
        $this->commentable_type = $model->getClass();
        $this->commentable_id = $model->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}