<?php

namespace App\Entities;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 */
class Clientes
{
    use Timestampable;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     */
    public $id;

    /**
    * @ORM\Column(name="documento", type="string", unique=true, nullable=false)
    */
    public $documento;

    /**
     * @ORM\Column(name="nombres", type="string", nullable=false)
     */
    public $nombres;

    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    public $email;

    /**
     * @ORM\Column(name="celular", type="string", nullable=false)
     */
    public $celular;


    public function __construct($documento, $nombres, $email, $celular)
    {
        $this->documento = $documento;
        $this->nombres = $nombres;
        $this->email = $email;
        $this->celular = $celular;
    }

    public function getId(){
        return $this->id;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento){
        $this->documento = $documento;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setCelular($celular){
        $this->celular = $celular;
    }
}
