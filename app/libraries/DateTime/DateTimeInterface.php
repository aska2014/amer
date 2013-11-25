<?php namespace DateTime;

interface DateTimeInterface {

    /**
     * @param string $format
     * @param string $date
     * @return string
     */
    public function date($format, $date);

    /**
     * Return true if the given date is valid (!= 1970/01/01)
     *
     * @param $date
     * @return bool
     */
    public function isValid( $date );

    /**
     * @param $datetime
     * @param bool $full
     * @return mixed
     */
    public function since($datetime, $full = false);
}