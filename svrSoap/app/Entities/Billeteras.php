<?php


namespace App\Entities;

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
     * @var integer $user_id
     * @ORM\Column(name="user_id", type="integer", unique=true, nullable=false)
     */
    private $user_id;

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


    public function __construct($hash, $user_id, $status, $currency)
    {
        $this->hash = $hash;
        $this->user_id = $user_id;
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

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
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

}
