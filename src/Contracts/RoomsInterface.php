<?php

namespace Innoboxrr\TwilioSdk\Contracts;

interface RoomsInterface
{
    /**
     * Genera un token de acceso para un participante de una sala de Twilio.
     *
     * @param string $identity El identificador del participante.
     * @param string $roomName El nombre de la sala.
     * @return string El token de acceso generado.
     */
    public function accessToken($identity, $roomName);

    /**
     * Obtiene información de una sala de Twilio por su nombre.
     *
     * @param string $name El nombre de la sala.
     * @return mixed La información de la sala.
     */
    public function getByName($name);

    /**
     * Obtiene información de una sala de Twilio por su SID.
     *
     * @param string $sid El SID de la sala.
     * @return mixed La información de la sala.
     */
    public function getBySid($sid);

    /**
     * Obtiene el SID de una sala de Twilio por su nombre.
     *
     * @param string $name El nombre de la sala.
     * @return string El SID de la sala.
     */
    public function getSid($name);

    /**
     * Marca una sala de Twilio como completada.
     *
     * @param string $name El nombre de la sala.
     * @return mixed La respuesta de la actualización.
     */
    public function complete($name);
}
