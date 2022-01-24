<?php


namespace App\Entities;

use App\Entities\Clientes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;

/**
 * Class Billeteras
 * @ORM\Entity
 * @ORM\Table(name="wallets")
 */
class Billeteras
{

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     */
    protected $id;

    /**
     * @var string $hash
     * @ORM\Column(name="hash", type="string", unique=true, nullable=false)
     */
    private $hash;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="Billeteras")
     * @var Clientes
     */
    private $clientes;

    /**
     * @var bool $status
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string $currency
     * @ORM\Column(name="currency", type="string", nullable=false)
     */
    private $currency;

    /**
     * Billeteras constructor.
     * @param string $hash
     * @param bool $status
     * @param string $currency
     */
    public function __construct(string $hash, bool $status = true, string $currency = "USD")
    {
        $this->hash = $hash;
        $this->status = $status;
        $this->currency = $currency;
    }


    public function getId(){
        return $this->id;
    }

    public function getHash(){
        return $this->hash;
    }

    public function setHash($hash){
        $this->hash = $hash;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getCurrency(){
        return $this->currency;
    }

    public function setCurrency($currency){
        $this->currency = $currency;
    }

    public function getClientes()
    {
        return $this->clientes;
    }

    public function setCliente(Clientes $cliente)
    {
        $this->clientes = $cliente;
    }

}
