<?php

class Price {

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