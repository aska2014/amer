<?php namespace Website;

use Kareem3d\Eloquent\Model;

class Page extends Model {

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected static $specsTable = 'page_specs';

    /**
     * @var array
     */
    protected static $specs = array('title', 'body');

    /**
     * @return Page
     */
    public static function getRealEstateInvestment()
    {
        $identifier = 'real_estate_investment';

        $investmentPage = static::where('identifier', $identifier)->first();

        if(! $investmentPage)
        {
            $investmentPage = new static(array(
                'identifier' => $identifier
            ));

            $investmentPage->save();

            $investmentPage->update(array('title' => 'Real estate investment', 'language' => 'en'));
            $investmentPage->update(array('title' => 'استثمارات عقارية', 'language' => 'ar'));
        }

        return $investmentPage;
    }

    /**
     * @return mixed
     */
    public static function getTopMenu()
    {
        return static::where('identifier', '!=', 'real_estate_investment')->get();
    }
}