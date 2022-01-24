<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Illuminate\Support\Facades\Hash;


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

    /**
     * @ORM\OneToMany(targetEntity="Billeteras", mappedBy="Clientes", cascade={"persist"})
     * @var ArrayCollection|Billeteras[]
     */
    private $billeteras;

    /**
     * @var string $password
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    public function __construct($documento, $nombres, $email, $celular, $password)
    {
        $this->setDocumento($documento);
        $this->setNombres($nombres);
        $this->setEmail($email);
        $this->setCelular($celular);
        $this->setPassword($password);
        $this->billeteras = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function setDocumento($documento):void{
        $this->documento = strtoupper($documento);
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setNombres($nombres): void
    {
        $this->nombres = strtoupper($nombres);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = strtoupper($email);
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setCelular($celular): void
    {
        $this->celular = $celular;
    }

    public function getBilleteras()
    {
        return $this->billeteras;
    }

    public function AgragarBilletera(Billeteras $billetera):void
    {
        if(!$this->billeteras->contains($billetera)) {
            $billetera->setCliente($this);
            $this->billeteras->add($billetera);
        }
    }

    public function setBilleteras(Billeteras $b): void
    {
        $this->billeteras = $b;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = Hash::make($password);
    }

}
