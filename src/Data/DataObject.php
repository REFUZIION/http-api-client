<?php

namespace Fuziion\HttpApi\Data;

class DataObject
{
    public function __construct(protected array $data)
    {
    }

    /**
     * Magic getter to navigate the DataObject
     *
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * Get DataObject as Array or retrieve a certain key value.
     *
     * @param $key
     * @return array|mixed|null
     */
    public function getData($key = null)
    {
        if(is_null($key)) {
            return $this->data;
        }

        return $this->data[$key] ?? null;
    }
}
