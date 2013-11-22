<?php namespace Kareem3d\FreakSeo;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Freak\Core\Package;
use Kareem3d\Freak;
use Kareem3d\Marketing\SEO;

class SEOPackage extends Package {

    /**
     * Load client configurations
     *
     * @param \Kareem3d\Freak $freak
     * @return void
     */
    public function run(Freak $freak)
    {
        // TODO: Implement run() method.
    }

    /**
     * @return string
     */
    public function formView()
    {
        return View::make('freak-seo::seo.package.form', array(
            'seo' => SEO::getByLink($this->getPackageData('Link')->getModel()) ?: new SEO()
        ));
    }

    /**
     * @return string
     */
    public function detailView()
    {
        return View::make('freak-seo::seo.package.detail', array(
            'seo' => SEO::getByLink($this->getPackageData('Link')->getModel())
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'SEO';
    }

    /**
     * @return mixed
     */
    public function store()
    {
        if($link = $this->getPackageData('link')->getModel())
        {
            // Get by link or create new seo with the link id
            $seo = SEO::getByLink( $link ) ?: new SEO(array('link_id' => $link->id));

            $seo->update(Input::get('SEO'));

            return $this->jsonSuccess();
        }

        return $this->jsonError(array('link must be defined'));
    }

    /**
     * @return mixed
     */
    public function update()
    {
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return false;
    }
}