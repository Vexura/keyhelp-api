<?php


namespace KeyHelpAPI\Clients;

use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\KeyHelpAPI;

class Clients
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
    public function getClients()
    {
        return $this->KeyHelpAPI->get('clients');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getClientById(int $id)
    {
        return $this->KeyHelpAPI->get('clients/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getClientByName(string $username)
    {
        return $this->KeyHelpAPI->get('clients/name/' . $username);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function createClient(string $username, string $lang, string $mail, string $password, string $comment, int $hostingPlan, bool $suspended, string $supendOn, string $deleteOn, string $skeleton, string $firstname, string $lastname, string $phone, string $city, string $address, string $zip, string $state, string $country, bool $sendCredentialMail = true, bool $createSystemDomain = true, string $company = null)
    {
        return $this->KeyHelpAPI->post('admins', [
            "username" => $username,
            "language" => $lang,
            "email" => $mail,
            "password" => $password,
            "notes" => $comment,
            "id_hosting_plan" => $hostingPlan,
            "is_suspended" => $suspended,
            "suspend_on" => $supendOn,
            "delete_on" => $deleteOn,
            "send_login_credentials" => $sendCredentialMail,
            "create_system_domain" => $createSystemDomain,
            "skeleton" => $skeleton,
            "contact_data" => [
                "first_name" => $firstname,
                "last_name" => $lastname,
                "company" => $company,
                "telephone" => $phone,
                "address" => $address,
                "city" => $city,
                "zip" => $zip,
                "state" => $state,
                "country" => $country,
            ]]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function updateAdmin(int $id, string $lang, string $mail, int $hostingPlanId, string $password = null)
    {
        return $this->KeyHelpAPI->put('clients/' . $id, [
            "language" => $lang,
            "email" => $mail,
            "password" => $password,
            "id_hosting_plan"=> $hostingPlanId,
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function deleteClient(int $id)
    {
        return $this->KeyHelpAPI->delete('clients/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getClientResources(int $id)
    {
        return $this->KeyHelpAPI->get('clients/' . $id . '/resources');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getClientStats(int $id)
    {
        return $this->KeyHelpAPI->get('clients/' . $id . '/stats');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getClientTraffic(int $id)
    {
        return $this->KeyHelpAPI->get('clients/' . $id . '/traffic');
    }

}