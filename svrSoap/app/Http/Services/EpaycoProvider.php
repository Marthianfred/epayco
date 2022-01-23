<?php


namespace App\Http\Services;


use App\Entities\Clientes;
use App\Repositories\ClientesRepository;

class EpaycoProvider
{

    /**
     * Retorna bandera de estado "boleano" para el "usuario y pass" suministrado.
     *
     * @param string $user
     * @param string $password
     * @return bool
     */
    public static function validateUser(string $user, string $password): bool
    {
        return $user === config('zoap.epayco.user') && ($password === config('zoap.epayco.password'));
    }

    /**
     * Returna el Token "string" del "usuario" suministrado.
     *
     * @param string $user
     * @return string
     */
    public static function getToken(string $user): string
    {
        return ($user == config('zoap.epayco.user')) ? config('zoap.epayco.token') : '';
    }

    /**
     * Retorna bandera de estado "boleano" para el "token" suministrado.
     *
     * @param string $token
     * @return bool
     */
    public static function validateToken(string $token): bool
    {
        return ($token == config('zoap.mock.token'));
    }

    /**
     *
     * Retorna True si un usuario existe con el token o el usuario o pass suministrado.
     *
     * @param string $token
     * @param string $user
     * @param string $password
     * @return bool
     */
    public static function authenticate(string $token = '', string $user = '', string $password = ''): bool
    {
        $result = false;

        if ($token) {
            $result = self::validateToken($token);
        } elseif ($user && $password) {
            $result = self::validateUser($user, $password);
        }

        return $result;
    }

    /**
     * Registro de Usuarios
     *
     * @param string $Documento
     * @param string $Nombres
     * @param string $Email
     * @param string $Celular
     *
     * @return array
     */

    public static function RegistrarCliente(
        string $Documento,
        string $Nombres,
        string $Email,
        string $Celular
    ):array
    {

        //logica con Doctrine para crear usuarios
        if (!$Documento){
            return ['status'=>false, 'error'=>['code'=>'Error-0001', 'msg'=>'El Documento no puede ser Nullo']];
        }
        if (!$Nombres){
            return ['status'=>false, 'error'=>['code'=>'Error-0002', 'msg'=>'Los Nombres no pueden ser Nullo']];
        }
        if (!$Email){
            return ['status'=>false, 'error'=>['code'=>'Error-0003', 'msg'=>'La Dirección E-mail no puede ser Nullo']];
        }
        if (!$Celular){
            return ['status'=>false, 'error'=>['code'=>'Error-0004', 'msg'=>'El numero Celular no puede ser Nullo']];
        }

        $cr = new ClientesRepository();

        if ($cr->isDocumento($Documento)){
            return ['status'=>false, 'error'=>['code'=>'Error-0005', 'msg'=>'Ya existe un usuario registrado con este Documento']];
        }

        if ($cr->isEmail($Email)){
            return ['status'=>false, 'error'=>['code'=>'Error-0006', 'msg'=>'Ya existe un usuario registrado con este Email']];
        }

        $result = $cr->create(new Clientes($Documento,$Nombres,$Email, $Celular));

        return ['status'=>true, 'cliente'=> $result];
    }
}
