<?php

namespace Innoboxrr\TwilioSdk\Twilio;

use Innoboxrr\TwilioSdk\Twilio\Authorization;
use Innoboxrr\TwilioSdk\Contracts\WhatsAppMessageSender;

class WhatsApp extends Authorization implements WhatsAppMessageSender
{
    protected $fromNumber;
    protected $toNumber;
    protected $message;
    protected $mediaUrl;

    // Bandera para verificar si los métodos han sido llamados
    protected $fromCalled = false;
    protected $toCalled = false;
    protected $messageCalled = false;

    public function from(int $fromNumber) : self
    {
        $this->fromNumber = $fromNumber;
        $this->fromCalled = true;

        return $this;
    }

    public function to(int $toNumber) : self
    {
        $this->toNumber = $toNumber;
        $this->toCalled = true;

        return $this;
    }

    public function message(string $message) : self
    {
        $this->message = $message;
        $this->messageCalled = true;

        return $this;
    }

    public function mediaUrl(string $mediaUrl) : self
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    public function sendMessage(): bool
    {
        if (!$this->fromCalled || !$this->toCalled || !$this->messageCalled) {
            throw new \Exception('Los métodos from(), to() y message() deben ser llamados antes de sendMessage()');
        }

        $this->checkEnv();

        $params = [
            'from' => 'whatsapp:' . $this->fromNumber,
            'body' => $this->message,
        ];

        if ($this->mediaUrl) {
            $params['mediaUrl'] = [$this->mediaUrl];
        }

        $message = $this->client->messages->create(
            'whatsapp:' . $this->toNumber,
            $params
        );

        return $message->sid !== null;
    }
}
