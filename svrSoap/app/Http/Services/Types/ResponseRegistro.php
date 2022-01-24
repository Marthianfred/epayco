<?php

namespace App\Http\Services\Types;

class ResponseRegistro
{
    /**
     * @var bool
     */
    public $status = false;

    /**
     * @var Error
     */
    public $error;

    /**
     * @var Cliente
     */
    public $cliente;

    /**
     * ResponseSoap constructor.
     * @param bool $status
     * @param Error $error
     * @param Cliente $cliente
     */
    public function __construct(bool $status, Error $error, Cliente $cliente)
    {
        $this->status = $status;
        $this->error = $error;
        $this->cliente = $cliente;
    }
}
