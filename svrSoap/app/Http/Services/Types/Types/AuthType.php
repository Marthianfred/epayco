<?php

namespace App\Http\Services\Types;

class AuthType
{
    /**
     * @var bool
     */
    public $status = false;

    /**
     * @var string
     */
    public $resultado = '';

    /**
     * Auth constructor.
     *
     * @param bool $status
     * @param string $resultado
     */
    public function __construct(bool $status, string $resultado)
    {
        $this->status = $status;
        $this->resultado = $resultado;
    }

}
