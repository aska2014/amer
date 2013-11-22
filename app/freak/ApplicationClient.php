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
//            Element::withDefaults('product', new Product()),
            Element::withDefaults('category', new EstateCategory()),
            Element::withDefaults('news', new News()),
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

//        $freak->modifyElement('product', function(Element $element)
//        {
//            $element->setController('FreakProductController');
//        });

        $freak->modifyElement('category', function(Element $element)
        {
            $element->setController('FreakCategoryController');
        });

        $freak->modifyElement('news', function(Element $element)
        {
            $element->setController('FreakNewsController');
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