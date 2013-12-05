<?php namespace Website;

use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;
use Kareem3d\Membership\User;

class BannerRequest extends Model {

    /**
     * @var string
     */
    protected $table = 'banner_requests';

    /**
     * @var array
     */
    protected $rules = array(
        'banner_place_id' => 'required|exists:banner_places,id',
    );

    /**
     * @var array
     */
    protected $arCustomMessages = array(
        'banner_place_id.required' => 'يجب إختيار مساحة الإعلان.',
        'banner_place_id.exists' => 'يجب إختيار مساحة الإعلان.'
    );

    /**
     * @return mixed|void
     */
    public function beforeValidate()
    {
        $this->cleanXSS();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(App::make('Kareem3d\Membership\User')->getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(BannerPlace::getClass(), 'banner_place_id');
    }
}