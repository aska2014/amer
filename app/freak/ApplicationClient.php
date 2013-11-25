<?php

use Illuminate\Support\Str;
use Kareem3d\Ecommerce\Order;
use Kareem3d\Freak;
use Kareem3d\Freak\Core\Element;
use Kareem3d\Freak\Menu\Icon;
use Kareem3d\Freak\Menu\Item;

class ApplicationClient extends Freak\Core\Client {

    /**
     * @return Element[]
     */
    public function elements()
    {
        return array(
            Element::withDefaults('estate', new Estate()),
            Element::withDefaults('category', new EstateCategory()),
            Element::withDefaults('news', new News()),
            Element::withDefaults('slider', new Slider())
        );
    }

    /**
     * Load client configurations
     *
     * @param \Kareem3d\Freak $freak
     * @return void
     */
    public function run(Freak $freak)
    {
        ClassLoader::addDirectories(__DIR__ . '/Controllers');
        View::addNamespace('panel', __DIR__ . '/views');

        $freak->modifyElement('estate', function(Element $element)
        {
            $element->setController('FreakEstateController');

            $element->setMenuItem(Item::make(
                'Estate', '', Icon::make('icon-archive')
            )->addChildren(array(
                    Item::make('Display all estates', $element->getUri(), Icon::make('icol-inbox'))
                )));
        });

        $freak->modifyElement('category', function(Element $element)
        {
            $element->setController('FreakCategoryController');
        });

        $freak->modifyElement('news', function(Element $element)
        {
            $element->setController('FreakNewsController');
        });

        $freak->modifyElement('slider', function(Element $element)
        {
            $element->setController('FreakSliderController');
        });
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'amer';
    }
}