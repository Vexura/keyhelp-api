<?php


namespace KeyHelpAPI\Admins;

use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\KeyHelpAPI;

class Admins
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
    public function getAdmins()
    {
        return $this->KeyHelpAPI->get('admins');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getAdminById(int $id)
    {
        return $this->KeyHelpAPI->get('admins/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getAdminByName(string $username)
    {
        return $this->KeyHelpAPI->get('admins/name/' . $username);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function createAdmin(string $username, string $lang, string $mail, bool $mainAdmin = false, string $password = null, string $passwordHash = null)
    {
        return $this->KeyHelpAPI->post('admins', [
            "username" => $username,
            "language" => $lang,
            "email" => $mail,
            "is_main_admin" => $mainAdmin,
            "password" => $password,
            "password_hash" => $passwordHash
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function updateAdmin(int $id, string $lang, string $mail, string $password = null)
    {
        return $this->KeyHelpAPI->put('admins/' . $id, [
            "language" => $lang,
            "email" => $mail,
            "password" => $password,
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function deleteAdmin(int $id)
    {
        return $this->KeyHelpAPI->delete('admins/' . $id);
    }

}