<?php

namespace App\Http\Services\Types;


class KeyValue
{
    /**
     * @var string
     */
    public $key = '';

    /**
     * @var string
     */
    public $value = '';

    /**
     * KeyValue constructor.
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key='', string $value='')
    {
        $this->key = $key;
        $this->value = $value;
    }

}
