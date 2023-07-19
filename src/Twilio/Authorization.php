<?php

namespace Innoboxrr\TwilioSdk\Twilio;

use Twilio\Rest\Client;

class Authorization
{

    protected $client;

    /**
     * Inicializa la instancia del cliente de Twilio.
     *
     * @param array $params El array asociativo con las credenciales de Twilio.
     * @throws \InvalidArgumentException Lanza una excepción si los parámetros no son válidos.
     */
    public function init(array $params)
    {

        // Comprueba que el array de parámetros contiene las claves 'sid' y 'token'
        if (!isset($params['sid']) || !isset($params['token'])) {
            throw new \InvalidArgumentException('Faltan los parámetros sid y/o token');
        }

        // Comprueba que 'sid' y 'token' son strings
        if (!is_string($params['sid']) || !is_string($params['token'])) {
            throw new \InvalidArgumentException('Los parámetros sid y token deben ser strings');
        }

        // Comprueba que 'sid' y 'token' no están vacíos
        if ($params['sid'] === '' || $params['token'] === '') {
            throw new \InvalidArgumentException('Los parámetros sid y token no pueden estar vacíos');
        }

        $this->client = new Client($params['sid'], $params['token']);

        return $this;

    }

    /**
     * Comprueba que el cliente de Twilio se ha inicializado.
     *
     * @throws \Exception Lanza una excepción si el cliente no se ha inicializado.
     * @return bool Retorna true si el cliente se ha inicializado.
     */
    protected function checkEnv() : bool
    {

        if ($this->client == null) {
            throw new \Exception('El cliente no está definido');
        }

        return true;

    }

}
