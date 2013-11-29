<?php namespace Helper;

class EmptyClass {

    public function __get( $property )
    {
        return $this;
    }

    public function __set( $property, $value )
    {

    }

    public function __call( $method, $arguments )
    {
        return $this;
    }


    public static function __callStatic( $method, $arguments )
    {
        return new static;
    }


    public function __toString()
    {
        return '';
    }
}