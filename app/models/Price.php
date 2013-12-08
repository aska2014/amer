<?php

class Price {

    /**
     * @var array
     */
    protected static $default;

    /**
     * @var float
     */
    protected $value;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $format;

    /**
     * @param $value
     * @param $currency
     * @param string $format
     */
    public function __construct( $value, $currency, $format = 'currency value' )
    {
        $this->value = (float) $value;
        $this->currency = $currency;
        $this->format = $format;
    }

    /**
     * @param $currency
     * @param $format
     */
    public static function init( $currency, $format )
    {
        static::$default = compact('currency', 'format');
    }

    /**
     * @param $value
     * @throws Exception
     * @return Price
     */
    public static function make( $value )
    {
        if(! isset(static::$default['currency']))
        {
            throw new Exception("Price class hasn't been initialized");
        }

        return new Price($value, static::$default['currency'], static::$default['format']);
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function formattedValue()
    {
       return number_format($this->value, 2);
    }

    /**
     * @return string
     */
    public function format()
    {
        $format = str_replace('currency', $this->currency, $this->format);

        return str_replace('value', $this->formattedValue(), $format);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->formattedValue();
    }
}