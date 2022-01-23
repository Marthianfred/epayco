<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use App\Entities\Billeteras;

/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 */
class Clientes
{
    // por si se quiere usar createdAt y updatedAt ///// use Timestampable;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     */
    protected $id;

    /**
    * @ORM\Column(name="documento", type="string", unique=true, nullable=false)
    */
    private $documento;

    /**
     * @ORM\Column(name="nombres", type="string", nullable=false)
     */
    private $nombres;

    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="celular", type="string", nullable=false)
     */
    private $celular;


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

    public function getBilleteras()
    {
        return $this->Billeteras;
    }

}
