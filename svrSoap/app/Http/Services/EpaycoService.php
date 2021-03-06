<?php

namespace App\Http\Services;

use App\Http\Services\Types\Error;
use App\Http\Services\Types\ResponseRegistro;
use App\Http\Services\Types\ResponseSoap;
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
     * @param string $password
     *
     * @return array
     * @throws SoapFault // Error Genrado Automatico.. u Manual
     */
    public function RegistrarCliente(
        string $user,
        string $token,
        string $documento,
        string $nombres,
        string $email,
        string $celular,
        string $password
    ):array
    {
        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $rc = Provider::RegistrarCliente($documento, $nombres, $email, $celular, $password);

        if ($rc->status)
        {
            header("Status: 201");

            return [
                'status'=>$rc->status,
                'msg' => 'Usuario Registrado con Exito',
                'cliente' =>[
                    'id' => $rc->cliente->id,
                    'documento' => $rc->cliente->documento,
                    'nombres' => $rc->cliente->nombres,
                    'email' => $rc->cliente->email,
                    'celular' => $rc->cliente->celular,
                    'billetera' =>[
                        'id' => $rc->cliente->billetera->id,
                        'hash' => $rc->cliente->billetera->hash,
                        'currency' => $rc->cliente->billetera->currency,
                        'status' => $rc->cliente->billetera->status
                    ]
                ]
            ];
        }
            else
        {
            $this->generarError($rc->error->codigo. ': ' . $rc->error->descripcion);
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

        if ($bb->status)
        {
            header("Status: 200");
            // retornamos la Billetera
            return ['status' => 'true', 'msg' => 'Billetera encontrada.!', 'cliente'=>$bb->result];
        }

        else
        {
            $this->generarError($bb->error->codigo. ': ' . $bb->error->descripcion);
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

        if ($bb->status)
        {
            header("Status: 200");
            // retornamos la Billetera
            return ['status' => $bb->status, 'msg' => 'Cliente encontrado.!', 'cliente'=>$bb->result];
        }

        else
        {
            $this->generarError($bb->error->codigo . ': ' . $bb->error->descripcion);
        }
    }

    /**
     * Funcion Actualizar Cliente
     * El Criterio de Busqueda es Documento no se permite actualizar el email
     *
     * @param string $user
     * @param string $token
     * @param string $documento
     * @param string $nombres
     * @param string $celular
     * @param string $password
     * @return array
     */
    public function ActualizarCliente(
        string $user,
        string $token,
        string $documento,
        string $nombres,
        string $celular,
        string $password
    ):array
    {

        if ($token != Provider::getToken($user)){
            header("Status: 401");
            throw new SoapFault('SOAP-ENV:Client', 'Error en Credenciales');
        }

        $cliente = Provider::ActualizarCliente(
            [
                'Documento'=>$documento,
                'Nombres' =>$nombres,
                'Celular' => $celular,
                'Password'=> $password
            ]);


        if ($cliente->status)
        {
            return ['status'=>$cliente->status, 'msg'=>'El cliente fue actualizado!', 'cliente'=> $cliente->result];
        }

        else
        {
            $this->generarError($cliente->error->codigo. ': ' . $cliente->error->descripcion);
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
