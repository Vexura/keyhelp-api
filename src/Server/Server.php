<?php


namespace KeyHelpAPI\Server;

use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\KeyHelpAPI;

class Server
{
    private $KeyHelpAPI;

    public function __construct(KeyHelpAPI $KeyHelpAPI)
    {
        $this->KeyHelpAPI = $KeyHelpAPI;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getServer()
    {
        return $this->KeyHelpAPI->get('server');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getPing()
    {
        return $this->KeyHelpAPI->get('ping');
    }

}