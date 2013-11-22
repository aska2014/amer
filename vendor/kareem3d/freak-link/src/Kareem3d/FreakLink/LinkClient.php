<?php namespace Kareem3d\FreakLink;

use Kareem3d\Freak\Core\Client;
use Kareem3d\Freak\Core\Element;
use Kareem3d\Freak;
use Kareem3d\Link\Link;

class LinkClient extends Client {

    /**
     * @return Element[]
     */
    public function elements()
    {
        return array(
            Element::withDefaults('Link')
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'link';
    }

    /**
     * Load client configurations
     *
     * @param \Kareem3d\Freak $freak
     * @return void
     */
    public function run(Freak $freak)
    {
        $freak->modifyElement('Link', function(Element $element)
        {
            $element->setController('Kareem3d\FreakLink\LinkController');
        });
    }
}