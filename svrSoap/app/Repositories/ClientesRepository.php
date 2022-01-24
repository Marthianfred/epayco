<?php

namespace App\Repositories;

use App\Entities\Clientes;
use Doctrine\ORM\ORMException;
use Illuminate\Support\Facades\Hash;
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
     *
     * @return Clientes
     */
    public static function update(Clientes $cliente, array $data): Clientes
    {
        $cliente->setNombres($data['Nombres']);
        $cliente->setCelular($data['Celular']);
        $cliente->setPassword(Hash::make($data['Password']));
        EntityManager::persist($cliente);
        EntityManager::flush();

        return $cliente;
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
     * @return Clientes|null
     */
    public static function FinByDoc($doc):?Clientes
    {
        $r= EntityManager::getRepository(Clientes::class)->findBy(['documento'=>$doc])[0];
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
     * @return Clientes|null
     */
    public static function finByEmail($email):?Clientes
    {
        $r = EntityManager::getRepository(Clientes::class)->findBy(['email'=>$email])[0];
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
