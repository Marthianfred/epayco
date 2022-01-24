<?php


namespace App\Http\Services\Types;


class Error
{
    /**
     * @var string
     */
    public $codigo;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * Error constructor.
     * @param string $codigo
     * @param string $descripcion
     */
    public function __construct(string $codigo = "", string $descripcion = "")
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
    }

}
