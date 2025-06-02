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

    protected $contentSid;
    protected $contentVariables = [];

    // Bandera para verificar si los métodos han sido llamados
    protected $fromCalled = false;
    protected $toCalled = false;

    public function from(int|string $fromNumber): self
    {
        $this->fromNumber = $fromNumber;
        $this->fromCalled = true;

        return $this;
    }

    public function to(int|string $toNumber): self
    {
        $this->toNumber = $toNumber;
        $this->toCalled = true;

        return $this;
    }

    // Mensaje libre
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function mediaUrl(string $mediaUrl): self
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    // Mensaje con plantilla
    public function contentSid(string $sid): self
    {
        $this->contentSid = $sid;

        return $this;
    }

    public function contentVariables(array $variables): self
    {
        $this->contentVariables = $variables;

        return $this;
    }

    public function sendMessage(): bool
    {
        if (!$this->fromCalled || !$this->toCalled) {
            throw new \Exception('Los métodos from() y to() deben ser llamados antes de sendMessage()');
        }

        $this->checkEnv();

        $params = [
            'from' => 'whatsapp:' . $this->fromNumber,
        ];

        // Usar plantilla si está definida
        if ($this->contentSid) {
            $params['contentSid'] = $this->contentSid;

            if (!empty($this->contentVariables)) {
                $params['contentVariables'] = json_encode($this->contentVariables);
            }
        }
        // Si no hay contentSid, enviar mensaje libre
        elseif ($this->message) {
            $params['body'] = $this->message;

            if ($this->mediaUrl) {
                $params['mediaUrl'] = [$this->mediaUrl];
            }
        } else {
            throw new \Exception('Debes proporcionar un mensaje libre o una plantilla con contentSid.');
        }

        $message = $this->client->messages->create(
            'whatsapp:' . $this->toNumber,
            $params
        );

        return $message->sid !== null;
    }
}
