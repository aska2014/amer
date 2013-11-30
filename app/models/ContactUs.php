<?php 

class ContactUs extends \Kareem3d\Eloquent\Model{

    /**
     * @var string
     */
    protected $table = 'contact_us';

    /**
     * @var array
     */
    protected $rules = array(
        'subject' => 'required',
        'body'    => 'required'
    );

    /**
     * @var array
     */
    protected $arCustomMessages = array(
        'subject.required' => 'يجب إدخال عنوان الرسالة',
        'body.required' => 'يجب إدخال نص الرسالة'
    );


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ownerInfo()
    {
        return $this->belongsTo(UserInfo::getClass(), 'owner_info_id');
    }
}