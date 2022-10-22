<?php


namespace KeyHelpAPI\Login;

use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\KeyHelpAPI;

class Login
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
    public function generateLoginUrl(int $userID)
    {
        return $this->KeyHelpAPI->get('login/'. $userID);
    }

}