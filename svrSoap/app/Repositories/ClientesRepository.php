<?php

namespace App\Repositories;

use App\Entities\Clientes;
use Doctrine\ORM\ORMException;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ClientesRepository
{

    /**
     * @param Clientes $cliente
     * @return Clientes
     */
    public static function crear(Clientes $cliente): Clientes
    {
        EntityManager::persist($cliente);
        EntityManager::flush();

        return $cliente;
    }

    /**
     * @param Clientes $cliente
     * @param array $data
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Clientes $cliente, array $data)
    {
        $cliente->setDocumento($data['documento']);
        $cliente->setNombres($data['nombres']);
        $cliente->setEmail($data['email']);
        $cliente->setCelular($data['celular']);
        EntityManager::persist($cliente);
        EntityManager::flush();
    }

    /**
     * @param $id
     * @return object|null
     */
    public function findById($id)
    {
        return EntityManager::getRepository(Clientes::class)->findOneBy([
            'id' => $id
        ]);
    }

    /**
     * Esta Funcion Valida si el documento ya existe
     * retorna un Bool para si o no
     *
     * no se permiten Clientes con el mismo Documento
     * @param $id
     * @return bool
     */
    public static function isDocumento($doc):bool
    {
        $r = EntityManager::getRepository(Clientes::class)->findOneBy(['documento'=>$doc]);
        if ($r){
            return true;
        }
        return false;
    }

    /**
     * Funcion que Busca un Cliente por Documento
     *
     * @param $doc
     * @return object[]
     */
    public static function FinByDoc($doc)
    {
        $r = EntityManager::getRepository(Clientes::class)->findBy(['documento'=>$doc]);
        return $r;
    }

    /**
     * Esta Funcion Valida si el Email ya existe
     * retorna un Bool para si o no
     *
     * no se permiten Clientes con el mismo Email
     * @param $id
     * @return bool
     */
    public static function isEmail($email):bool
    {
        $r = EntityManager::getRepository(Clientes::class)->findOneBy(['email'=>$email]);
        if ($r){
            return true;
        }

        return false;
    }

    /**
     * funcion que busca un Cliente por Email
     *
     * @param $email
     * @return object[]
     */
    public static function finByEmail($email)
    {
        $r = EntityManager::getRepository(Clientes::class)->findBy(['email'=>$email]);
        return $r;
    }

    /**
     *
     *
     * @param Clientes $clientes
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Clientes $clientes)
    {
        EntityManager::remove($clientes);
        EntityManager::flush();
    }

}
