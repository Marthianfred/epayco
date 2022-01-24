<?php


namespace App\Repositories;


use App\Entities\Billeteras;
use LaravelDoctrine\ORM\Facades\EntityManager;

class BilletaraRepository
{

    /**
     * Funcion para Crear Billetara
     * @param Billeteras $billetera
     * @return Billeteras
     */
    public static function crear(Billeteras $billetera): Billeteras{

        EntityManager::persist($billetera);
        EntityManager::flush();

        return $billetera;
    }

    /**
     * Funcion que se valida que Hash ya no este registrado
     * @param $hash
     * @return bool
     */
    public static function isHash($hash):bool{

        $h = EntityManager::getRepository(Billeteras::class)->findOneBy(['hash'=>$hash]);
        if ($h){
            return true;
        }

        return false;
    }

    /**
     * Funcion que Genera un Hash Valido para un Wallet
     * @param string $isoCurrency
     * @return string
     */
    public static function generateHash(string $isoCurrency = 'USD'): string
    {
        $hash = uniqid('Epayco-' . $isoCurrency . '-', true);

        if (!BilletaraRepository::isHash($hash)){
            return $hash;
        }

        return BilletaraRepository::generateHash($isoCurrency);
    }

    /**
     * Esta funcion retorna la billetera segun el HASH
     *
     * @param string $hash
     *
     */
    public static function findByHash(string $hash){

        $r = EntityManager::getRepository(Billeteras::class)->findBy(['hash'=>$hash]);
        return $r;
    }

    public function recargarBilletera(){

    }

}
