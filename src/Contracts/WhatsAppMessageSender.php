<?php

namespace Innoboxrr\TwilioSdk\Contracts;

/**
 * Interface WhatsAppMessageSender
 *
 * Esta interfaz define los métodos necesarios para enviar un mensaje de WhatsApp utilizando la API de Twilio.
 *
 * Para implementar esta interfaz, tu clase debe definir los siguientes métodos:
 * - from(int $fromNumber): self
 * - to(int $toNumber): self
 * - message(string $message): self
 * - sendMessage(): bool
 *
 * Los métodos from(), to() y message() deben ser llamados en el orden correcto antes de llamar sendMessage().
 *
 * @package Innoboxrr\TwilioSdk\Contracts
 */
interface WhatsAppMessageSender
{
    /**
     * Establece el número de teléfono del remitente del mensaje.
     *
     * @param int $fromNumber El número de teléfono del remitente.
     * @return self Retorna la instancia actual para permitir el encadenamiento de métodos.
     */
    public function from(int $fromNumber): self;

    /**
     * Establece el número de teléfono del destinatario del mensaje.
     *
     * @param int $toNumber El número de teléfono del destinatario.
     * @return self Retorna la instancia actual para permitir el encadenamiento de métodos.
     */
    public function to(int $toNumber): self;

    /**
     * Establece el cuerpo del mensaje de WhatsApp.
     *
     * @param string $message El cuerpo del mensaje.
     * @return self Retorna la instancia actual para permitir el encadenamiento de métodos.
     */
    public function message(string $message): self;

    /**
     * Envía el mensaje de WhatsApp al destinatario configurado.
     *
     * Los métodos from(), to() y message() deben ser llamados en ese orden antes de llamar a este método.
     *
     * @return bool Retorna true si el mensaje se envió correctamente, false en caso contrario.
     * @throws \Exception Lanza una excepción si los métodos from(), to() y message() no se han llamado en el orden correcto.
     */
    public function sendMessage(): bool;
}
