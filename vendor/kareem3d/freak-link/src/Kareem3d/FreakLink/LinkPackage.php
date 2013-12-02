<?php namespace Kareem3d\FreakLink;

use Helper\EmptyClass;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Kareem3d\Eloquent\Model;
use Kareem3d\Freak\Core\Package;
use Kareem3d\Freak;
use Kareem3d\Freak\Core\PackageData;
use Kareem3d\Link\Link;
use Kareem3d\Link\LinkRepository;

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
        ))->__toString();
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
        $link = App::make('Kareem3d\Link\DynamicLink')->getByPageAndModel($this->getExtra('link-page'), $this->getElementData()->getModel());

        return $link ?: App::make('Kareem3d\Link\DynamicLink');
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
        $model = $this->getElementData()->getModel();

        if(! $model) return;

        $link = App::make('Kareem3d\Link\DynamicLink')->create(array(

            'page_name'     => $this->getExtraRequired('link-page'),
            'url'           => Input::get('Link.url'),
            'linkable_type' => $model->getClass(),
            'linkable_id'   => $model->getKey()
        ));

        return $this->jsonSuccess(array(
            'packageData' => array(
                'model_type' => $link->getClass(),
                'model_id'   => $link->getKey(),
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