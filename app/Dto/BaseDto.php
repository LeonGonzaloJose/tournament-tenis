<?php

namespace App\Dto;

use JsonSerializable;

abstract class BaseDto implements JsonSerializable{

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    protected function fill(array $attributes){
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);   
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}