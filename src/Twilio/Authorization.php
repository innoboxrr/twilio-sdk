<?php

namespace Innoboxrr\TwilioSdk\Twilio;

use Twilio\Rest\Client;

class Authorization
{

    protected $client;

    protected $sid;

    protected $token;

    protected $apiKey;

    protected $apiSecret;

    /**
     * Inicializa la instancia del cliente de Twilio.
     *
     * @param array $params El array asociativo con las credenciales de Twilio.
     * @throws \InvalidArgumentException Lanza una excepción si los parámetros no son válidos.
     */
    public function init(array $params)
    {

        if (isset($params['sid']) && is_string($params['sid']) && $params['sid'] !== '') {
            $this->sid = $params['sid'];
        }

        if (isset($params['token']) && is_string($params['token']) && $params['token'] !== '') {
            $this->token = $params['token'];
        }

        if (isset($params['apiKey']) && is_string($params['apiKey']) && $params['apiKey'] !== '') {
            $this->apiKey = $params['apiKey'];
        }

        if (isset($params['apiSecret']) && is_string($params['apiSecret']) && $params['apiSecret'] !== '') {
            $this->apiSecret = $params['apiSecret'];
        }

        // Comprueba que 'sid' y 'token' están presentes
        if (empty($this->sid) || empty($this->token)) {
            throw new \InvalidArgumentException('Faltan los parámetros sid y/o token');
        }

        $this->client = new Client($this->sid, $this->token);

        return $this;

    }

    /**
     * Comprueba que el cliente de Twilio se ha inicializado.
     *
     * @throws \Exception Lanza una excepción si el cliente no se ha inicializado.
     * @return bool Retorna true si el cliente se ha inicializado.
     */
    protected function checkEnv($full = false) : bool
    {

        if ($this->client == null) {
            throw new \Exception('El cliente no está definido');
        }

        if ($full && (!$this->apiKey || !$this->apiSecret)) {
            throw new \Exception('No se han definido las credenciales de la API');
        }

        return true;

    }


    /**
     * Crea nuevas credenciales API para apiKey y apiSecret.
     *
     * @param string $name El nombre asociado a las nuevas credenciales.
     * @return mixed Las nuevas credenciales API generadas.
     */
    private function createApiKeys($name) 
    {
        
        return $this->client->newKeys->create(["friendlyName" => $name]);

    }

}
