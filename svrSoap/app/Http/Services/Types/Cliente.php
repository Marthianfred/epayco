<?php


namespace App\Http\Services\Types;


use function Symfony\Component\Translation\t;

class Cliente
{
    /**
     * @var int|null
     */
    public $id;

    /**
     * @var string
     */
    public $documento;

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $celular;

    /**
     * @var Billetera
     */
    public $billetera;

    /**
     * Cliente constructor.
     * @param int $id
     * @param string $documento
     * @param string $nombres
     * @param string $email
     * @param string $celular
     * @param Billetera $billetera
     */
    public function __construct(
        int $id = null,
        string $documento ="",
        string $nombres="",
        string $email="",
        string $celular = "",
        Billetera $billetera = null
    ){
        $this->id = $id;
        $this->documento = $documento;
        $this->nombres = $nombres;
        $this->email = $email;
        $this->celular = $celular;
        $this->billetera = $billetera;
    }

}
