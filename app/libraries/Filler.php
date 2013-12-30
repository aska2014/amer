<?php

use Kareem3d\Eloquent\Model;

class Filler {

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $oldInputs;

    /**
     * @param Model $model
     * @param $oldInputs
     */
    public function __construct($model, $oldInputs)
    {
        $this->model = $model;
        $this->oldInputs = $oldInputs ?: array();
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = '')
    {
        // If is in the old inputs then return it
        if(isset($this->oldInputs[$key]))
        {
            return $this->oldInputs[$key];
        }

        // If in the model return it
        if($this->model and ($value = $this->model->getAttribute($key)))
        {
            return $value;
        }

        return $default;
    }
}