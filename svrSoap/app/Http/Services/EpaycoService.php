<?php

namespace App\Http\Services;

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
        string $user,
        string $token,
        string $documento,
        string $nombres,
        string $email,
        string $celular
    ):array
    {
        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $rc = Provider::RegistrarCliente($documento, $nombres, $email, $celular);

        if ($rc['status'])
        {
            header("Status: 201");
            // retornamos el usuario
            return ['status' => 'true', 'msg' => 'Cliente registrado con exito.!', 'cliente'=>$rc['cliente'] , 'billetera'=>$rc['billetera']];
        }
            else
        {
            $this->generarError($rc['error']['code']. ': ' . $rc['error']['msg']);
        }
    }

    /**
     * Funcion para buscar una Billetera segun su HASH
     * @param string $user
     * @param string $token
     * @param string $hash
     * @return array
     * @throws SoapFault
     */
    public function BuscarBilleteraHASH(
        string $user,
        string $token,
        string $hash
    ):array
    {
        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $bb = Provider::BuscarHASH($hash);

        if ($bb['status'])
        {
            header("Status: 200");
            // retornamos la Billetera
            return ['status' => 'true', 'msg' => 'Billetera encontrada.!', 'billetera'=>$bb['billeteras']];
        }

        else
        {
            $this->generarError($bb['error']['code']. ': ' . $bb['error']['msg']);
        }
    }

    /**
     * Funcion para buscar Clientes segun su Documento
     * @param string $user
     * @param string $token
     * @param string $hash
     * @return array
     * @throws SoapFault
     */
    public function BuscarClientesDOCUMENTO(
        string $user,
        string $token,
        string $documento
    ):array
    {
        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $bb = Provider::BuscarDocumento($documento);

        if ($bb['status'])
        {
            header("Status: 200");
            // retornamos la Billetera
            return ['status' => 'true', 'msg' => 'Billetera encontrada.!', 'cliente'=>$bb['cliente']];
        }

        else
        {
            $this->generarError($bb['error']['code']. ': ' . $bb['error']['msg']);
        }
    }

    /**
     * Funcion para buscar Clientes segun su Email
     * @param string $user
     * @param string $token
     * @param string $hash
     * @return array
     * @throws SoapFault
     */
    public function BuscarClientesEMAIL(
        string $user,
        string $token,
        string $email
    ):array
    {
        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $bb = Provider::BuscarEmail($email);

        if ($bb['status'])
        {
            header("Status: 200");
            // retornamos la Billetera
            return ['status' => 'true', 'msg' => 'Billetera encontrada.!', 'cliente'=>$bb['cliente']];
        }

        else
        {
            $this->generarError($bb['error']['code']. ': ' . $bb['error']['msg']);
        }
    }

    /**
     *
     * @param string $code
     * @param string $msg
     *
     * @throws SoapFault
     */
    private function generarError(string $msg , string $code = "SOAP-ENV:Client"){
        header("Status: 400");
        throw new SoapFault($code, $msg);
    }
}
