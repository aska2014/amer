<?php

class Area {

    /**
     * @var float
     */
    protected $value;

    /**
     * @var string
     */
    protected $metric;

    /**
     * @param $value
     * @param $metric
     */
    public function __construct( $value, $metric )
    {
        $this->value = (float) $value;
        $this->metric = $metric;
    }

    /**
     * @param $value
     * @param $metric
     * @return Area
     */
    public static function make($value, $metric)
    {
        return new static($value, $metric);
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
    public function format()
    {
        return $this->value . ' ' . $this->metric;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }
}