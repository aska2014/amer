<?php namespace Website;

use Kareem3d\Eloquent\Model;

class ContactInfo extends Model {

    const EMAIL = 0;
    const MOBILE_NUMBER = 1;
    const TELEPHONE_NUMBER = 2;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'contact_info';

    /**
     * @param $title
     * @param $type
     * @param $index
     * @return ContactInfo
     */
    public static function createOrUpdate( $title, $type, $index)
    {
        // Get all by type
        $all = static::where('type', $type)->get(array('id', 'title'));

        // If index exists then update it
        if(isset($all[$index]))
        {
            $all[$index]->update(compact('title'));

            return $all[$index];
        }

        // Else then create it
        else
        {
            return static::create(compact('title', 'type'));
        }

    }

    /**
     * @return string
     */
    public static function getMainEmail()
    {
        $contact = static::getFirstByType(static::EMAIL);

        return $contact ? $contact->title : '';
    }

    /**
     * @param $limit
     * @return array
     */
    public static function getMobileNumbers( $limit )
    {
        return static::where('type', static::MOBILE_NUMBER)
                     ->limit($limit)
                     ->get(array('title'))->lists('title');
    }

    /**
     * @return mixed
     */
    public static function getMainMobileNumber()
    {
        return array_shift(static::getMobileNumbers(1));
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getFirstByType( $type )
    {
        return static::where('type', $type)->first(array('title'));
    }

}