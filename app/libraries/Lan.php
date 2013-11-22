<?php

class Lan {

    const KEY_NAME = 'language';

    /**
     * @var array
     */
    protected $available;

    /**
     * @var
     */
    protected $default;

    /**
     * @var string
     */
    protected $language = null;

    /**
     * @param array $available
     * @param $default
     */
    public function __construct( array $available, $default )
    {
        $this->available = $available;
        $this->default = $default;
    }

    /**
     * @return array
     */
    public function availableLanguages()
    {
        return $this->available;
    }

    /**
     * @param $language
     * @return bool
     */
    public function is( $language )
    {
        return $this->get() == $language;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if($this->language) return $this->language;

        $language = Session::get( self::KEY_NAME );

        // If not isset language or not correct then change it to default and return the default
        if(! $language || !in_array($language, $this->available))
        {
            $this->change($this->default);

            return $this->language = $this->default;
        }

        else
        {
            return $this->language = $language;
        }
    }

    /**
     * @param $lan
     */
    public function change( $lan )
    {
        Session::put(self::KEY_NAME, $lan);
    }

}