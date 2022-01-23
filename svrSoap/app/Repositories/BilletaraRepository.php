<?php


namespace App\Repositories;


use App\Entities\Billeteras;
use LaravelDoctrine\ORM\Facades\EntityManager;


class BilletaraRepository
{

    public function create(Billeteras $billetera){

        EntityManager::persist($billetera);
        EntityManager::flush();

        return $billetera;
    }


    public function isHash($hash):bool{

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
    public function generateHash($isoCurrency = 'USD'): string
    {
        $hash = uniqid('Epayco-' . $isoCurrency . '-', true);

        if (!$this->isHash($hash)){
            return $hash;
        }

        return $this->generateHash($isoCurrency);
    }
}
