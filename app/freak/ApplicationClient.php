<?php

use Estate\Estate;
use Estate\EstateCategory;
use Illuminate\Support\Str;
use Kareem3d\Ecommerce\Order;
use Kareem3d\Freak;
use Kareem3d\Freak\Core\Element;
use Kareem3d\Freak\Menu\Icon;
use Kareem3d\Freak\Menu\Item;
use Special\Special;
use Special\SpecialOffer;
use Special\SpecialPayment;

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
            Element::withDefaults('slider', new Slider()),
            Element::withDefaults('offer', new SpecialOffer()),
            Element::withDefaults('payment', new SpecialPayment()),
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
            $element->setMenuItem(Item::make(
                'Estate', '', Icon::make('icon-archive')
            )->addChildren(array(
                    Item::make('Display special estates', $element->getUri('special'), Icon::make('icol-coins')),
                    Item::make('Display new estates', $element->getUri('not-accepted'), Icon::make('icol-award-star-gold')),
                    Item::make('Display accepted estates', $element->getUri('accepted'), Icon::make('icol-accept')),
                    Item::make('Display all estates', $element->getUri(), Icon::make('icol-inbox')),
                )));
        });


        $freak->modifyElement('payment', function(Element $element)
        {
            $element->setMenuItem(Item::make(
                'Payments', '', Icon::make('icon-archive')
            )->addChildren(array(
                    Item::make('Display all payments', $element->getUri(), Icon::make('icol-inbox')),
                )));

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