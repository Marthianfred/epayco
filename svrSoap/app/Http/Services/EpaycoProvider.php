<?php


namespace App\Http\Services;


use App\Entities\Billeteras;
use App\Entities\Clientes;
use App\Http\Services\Types\Error;
use App\Http\Services\Types\ResponseSoap;
use App\Repositories\BilletaraRepository;
use App\Repositories\ClientesRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

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
     * @return string|null
     */
    public static function getToken(string $user): ? string
    {
        return ($user === config('zoap.epayco.user')) ? config('zoap.epayco.token') : null;
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
     * @param string $Password
     *
     * @return ResponseSoap
     */
    public static function RegistrarCliente(
        string $Documento,
        string $Nombres,
        string $Email,
        string $Celular,
        string $Password
    ): ResponseSoap
    {
        //logica con Doctrine para crear usuarios
        if (!$Documento){
            return new ResponseSoap(false, new Error('Error-0001', 'El Documento no puede ser Nullo'),[]);
        }
        if (!$Nombres){
            return new ResponseSoap(false, new Error('Error-0002', 'Los Nombres no pueden ser Nullo'),[]);
        }
        if (!$Email){
            return new ResponseSoap(false, new Error('Error-0003', 'La Dirección E-mail no puede ser Nullo'),[]);
        }
        if (!$Celular){
            return new ResponseSoap(false, new Error('Error-0004', 'El numero Celular no puede ser Nullo'),[]);
        }

        if (ClientesRepository::isDocumento($Documento)){
            return new ResponseSoap(false, new Error('Error-0005', 'Ya existe un usuario registrado con este Documento'),[]);
        }

        if (ClientesRepository::isEmail($Email)){
            return new ResponseSoap(false, new Error('Error-0006', 'Ya existe un usuario registrado con este Email'),[]);
        }
        if (!$Password){
            return new ResponseSoap(false, new Error('Error-0007', 'el password no puede ser nulo'),[]);
        }

        $cliente = new Clientes($Documento,$Nombres,$Email, $Celular,$Password);

        $cliente->AgragarBilletera(new Billeteras(strtoupper(BilletaraRepository::generateHash("USD"))));

        $result = ClientesRepository::crear($cliente);

        // se toma encuenta la primera... un cliente asume que puede tener diferentes Billeteras
        // en este Ejmplo de Ilustracion solo estoy tratando con 1 sola "USD"
        $billetera = $result->getBilleteras()->first();

        // se pudo llamar a new Clientes() para crear el objecto
        // mas dicidi dejarlo asi como ejemplo a Valores que se retornan en el SOAP
        // a mano
        $c = [
            'id' => $result->getId(),
            'documento' => $result->getDocumento(),
            'nombres' => $result->getNombres(),
            'email' => $result->getEmail(),
            'celular' => $result->getCelular(),
            'billetera' => [
                'id' => $billetera->getId(), // id de la Billetera
                'hash' => $billetera->getHash(), // Hash de la Billetera
                'currency' => $billetera->getCurrency(), // Moneda de la Billetera
                'status' => $billetera->getStatus(), // Estado de la Billetera
            ]
        ];

        return new ResponseSoap(true, new Error(),$c);
    }

    /**
     * Busca el hash en la Billetera del cliente
     * @param string $hash
     * @return array
     */
    public static function BuscarHASH(string $hash):array
    {
        if (!$hash){
            return ['status'=>false, 'error'=>['code'=>'Error-0008', 'msg'=>'El hash a Buscar no puede ser Nulo']];
        }

        $billetera = BilletaraRepository::findByHash($hash);

        if (!$billetera){
            return ['status'=>false, 'error'=>['code'=>'Error-0009', 'msg'=>'El hash a Buscar no existe']];
        }

        $result = [
            'id' => $billetera[0]->getId(),
            'hash' => $billetera[0]->getHash(),
            'currency' => $billetera[0]->getCurrency(),
            'status' => $billetera[0]->getStatus()
        ];

        return ['status'=>true, 'billeteras'=> $result];
    }

    /**
     * Provider para buscar Documento
     * @param string $documento
     * @return array
     */
        public static function BuscarDocumento(string $documento):array{
        if (!$documento){
            return ['status'=>false, 'error'=>['code'=>'Error-0010', 'msg'=>'El Documento a Buscar no puede ser Nulo']];
        }

        $result = ClientesRepository::FinByDoc($documento)[0];
        if (!$result){
            return ['status'=>false, 'error'=>['code'=>'Error-0011', 'msg'=>'El Documento a Buscar no Existe']];
        }

        $c = [
            'id' => $result->getId(),
            'documento' => $result->getDocumento(),
            'nombres' => $result->getNombres(),
            'email' => $result->getEmail(),
            'celular' => $result->getCelular(),
        ];

        //lo expongo como Array por si.... es posible que un cliente mismo doc tenga varias cuentas
        return ['status'=>true, 'cliente'=>$c];

    }

    /**
     * Provider para buscar Email
     *
     * @param string $email
     * @return array
     */
    public static function BuscarEmail(string $email):array{
        if (!$email){
            return ['status'=>false, 'error'=>['code'=>'Error-0012', 'msg'=>'El Email a Buscar no puede ser Nulo']];
        }

        $result = ClientesRepository::FinByEmail($email)[0];
        if (!$result){
            return ['status'=>false, 'error'=>['code'=>'Error-0013', 'msg'=>'El Email a Buscar no Existe']];
        }

        $c = [
            'id' => $result->getId(),
            'documento' => $result->getDocumento(),
            'nombres' => $result->getNombres(),
            'email' => $result->getEmail(),
            'celular' => $result->getCelular(),
        ];

        //lo expongo como Array por si.... es posible que un cliente mismo doc tenga varias cuentas
        return ['status'=>true, 'cliente'=>$c];

    }
}
