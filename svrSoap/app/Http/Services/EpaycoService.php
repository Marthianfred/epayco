<?php

namespace App\Http\Services;

use App\Entities\Billeteras;
use App\Http\Services\Types\AuthType;
use phpDocumentor\Reflection\Types\Array_;
use SoapFault;
use App\Http\Services\EpaycoProvider as Provider;

class EpaycoService
{

    /*
    |--------------------------------------------------------------------------
    | Public Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Autentica un usuario dentro de la plataforma.
     *
     * @param string $user
     * @param string $password
     * @return array
     * @throws SoapFault
     *
     */
    public function auth(
        string $user,
        string $password
    ): array
    {
        if (Provider::validateUser($user, $password)) {
            header("Status: 200");
            return ['status' => true, 'token'=> Provider::getToken($user)];
        } else {
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }
    }

    /**
     * Registra un Cliente en la plaforma
     *
     * @param string $documento
     * @param string $nombres
     * @param string $email
     * @param string $celular
     *
     * @return array // [Status, msg, cliente]
     * @throws SoapFault // Error Genrado Automatico.. u Manual
     */
    public function RegistrarCliente(
        string $token,
        string $documento,
        string $nombres,
        string $email,
        string $celular
    ):array
    {

        if (is_null(Provider::getToken($token))){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $rc = Provider::RegistrarCliente($documento, $nombres, $email, $celular);

        if ($rc['status'])
        {
            // retornamos el usuario
            return ['status' => 'true', 'msg' => 'Cliente registrado con exito.!', 'cliente'=>$rc['cliente'] , 'billetera'=>$rc['billetera']];
        }
            else
        {
            header("Status: 400");
            //code o msg ver EpaycoProvider
            throw new SoapFault('SOAP-ENV:Client', $rc['error']['code']. ': ' . $rc['error']['msg']);
        }
    }
}
