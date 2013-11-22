<?php namespace Kareem3d\FreakLink;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Eloquent\Model;
use Kareem3d\Freak\Core\Package;
use Kareem3d\Freak;
use Kareem3d\Freak\Core\PackageData;
use Kareem3d\Link\Link;

class LinkPackage extends Package {

    /**
     * @var Freak
     */
    protected $freak;

    /**
     * Load client configurations
     *
     * @param \Kareem3d\Freak $freak
     * @return void
     */
    public function run(Freak $freak)
    {
        $this->freak = $freak;
    }

    /**
     * @return string
     */
    public function formView()
    {
        $link = $this->getLink();

        foreach($this->freak->getCurrentElement()->getPackages() as $package)
        {
            $package->addData(new PackageData($link, 'Link'));
        }

        return View::make('freak-link::link.package.form', array(
            'link' => $link
        ));
    }

    /**
     * @return string
     */
    public function detailView()
    {
        $link = $this->getLink();

        foreach($this->freak->getCurrentElement()->getPackages() as $package)
        {
            $package->addData(new PackageData($link, 'Link'));
        }

        return View::make('freak-link::link.package.detail', array(
            'link' => $link
        ));
    }

    /**
     * @return Link
     */
    protected function getLink()
    {
        $link = Link::getByPageAndModel($this->getExtra('link-page'), $this->getElementData()->getModel());

        return $link ?: new Link();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Link';
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $link = $this->getLink();

        $link->update(array(
            'relative_url' => Input::get('Link.relative_url'),
            'page_name' => $this->getExtraRequired('link-page'),
            'arguments' => $this->getExtra('link-arguments', array())
        ));

        $link->attachTo($this->getElementData()->getModel());

        return $this->jsonSuccess(array(
            'packageData' => array(
                'model_type' => $link->getClass(),
                'model_id'   => $link->id,
                'from'       => 'link',
            )
        ));
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