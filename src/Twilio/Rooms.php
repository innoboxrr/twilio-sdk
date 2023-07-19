<?php

namespace Innoboxrr\TwilioSdk\Twilio;

use Innoboxrr\TwilioSdk\Twilio\Authorization;
use Innoboxrr\TwilioSdk\Contracts\RoomsInterface;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class Rooms extends Authorization implements RoomsInterface
{

    /**
     * Genera un token de acceso para un participante de una sala de Twilio.
     *
     * @param string $identity El identificador del participante.
     * @param string $roomName El nombre de la sala.
     * @return string El token de acceso generado.
     */
    public function accessToken($identity, $roomName)
    {

        $this->checkEnv(true);

        $token = new AccessToken(
            $this->sid,
            $this->apiKey,
            $this->apiSecret,
            3600,
            $identity 
        );

        $grant = new VideoGrant();
        
        $grant->setRoom($roomName);

        $token->addGrant($grant);

        return $token->toJWT();

    }

    public function getByName($name)
    {

        $this->checkEnv();

        return $this->client->video->v1->rooms($name)->fetch();
    
    }

    public function getBySid($sid)
    {
        
        $this->checkEnv();

        return $this->client->video->v1->rooms($sid)->fetch();
    
    }

    public function getSid($name)
    {

        $this->checkEnv();

        $room = $this->getByName($name);
        
        return $room->sid;
    
    }

    public function complete($name)
    {
        
        $this->checkEnv();

        return $this->client->video->v1->rooms($name)->update("completed");
    
    }

}