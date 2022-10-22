<?php


namespace KeyHelpAPI;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use KeyHelpAPI\Admins\Admins;
use KeyHelpAPI\Clients\Clients;
use KeyHelpAPI\HostingPlans\HostingPlans;
use KeyHelpAPI\Login\Login;
use Psr\Http\Message\ResponseInterface;
use KeyHelpAPI\Accounts\Accounts;
use KeyHelpAPI\Configuration\Configuration;
use KeyHelpAPI\Exception\ParameterException;
use KeyHelpAPI\GeoLocation\GeoLocation;
use KeyHelpAPI\Servers\Servers;

class KeyHelpAPI
{
    private $httpClient;
    private $credentials;
    private $apiToken;
    private $apiIp;
    private $adminsHandler;
    private $clientsHandler;
    private $hostingPlansHandler;
    private $loginHandler;

    /**
     * KeyHelpAPI constructor.
     *
     * @param string $token API Token for all requests
     * @param null $httpClient
     */
    public function __construct(string $token, string $apiIp, $httpClient = null) {
        $this->apiToken = $token;
        $this->apiIp = $apiIp;
        $this->setHttpClient($httpClient);
        $this->setCredentials($token, $apiIp);
    }


    public function setHttpClient(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120,
            'http_errors' => false,
        ]);
    }

    public function setCredentials(string $token, string $host)
    {
        if (!$token instanceof Credentials || !$host instanceof Credentials) {
            $credentials = new Credentials($token, $host);
        } else{
            $credentials = null;
        }

        $this->credentials = $credentials;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->apiToken;
    }

    /**
     * @return string
     */
    public function getIP()
    {
        return $this->apiIp;
    }


    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }


    /**
     * @param string $actionPath The resource path you want to request, see more at the documentation.
     * @param array $params Array filled with request params
     * @param string $method HTTP method used in the request
     *
     * @return ResponseInterface
     *
     * @throws ParameterException|GuzzleException If the given field in params is not an array
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl() . $actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'X-API-Key ' . $this->apiToken]]);
            case 'POST':
                return $this->getHttpClient()->post($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'X-API-Key ' . $this->apiToken], 'json' => $params]);
            case 'PUT':
                return $this->getHttpClient()->put($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'X-API-Key ' . $this->apiToken], 'json' => $params]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'X-API-Key ' . $this->apiToken]]);
            case 'PATCH':
                return $this->getHttpClient()->patch($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'X-API-Key ' . $this->apiToken], 'json' => $params]);
            default:
                throw new ParameterException('Wrong HTTP method passed');
        }
    }

    private function processRequest(ResponseInterface $response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }


    /**
     * @throws GuzzleException
     */
    public function get($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params);

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function post($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function put($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function delete($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function patch($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PATCH');

        return $this->processRequest($response);
    }

    /**
     * @return Admins
     */
    public function admins(): Admins
    {
        if (!$this->adminsHandler) $this->adminsHandler = new Admins($this);
        return $this->adminsHandler;
    }

    /**
     * @return Clients
     */
    public function clients(): Clients
    {
        if (!$this->clientsHandler) $this->clientsHandler = new Clients($this);
        return $this->clientsHandler;
    }

    /**
     * @return HostingPlans
     */
    public function hostingPlans(): HostingPlans
    {
        if (!$this->hostingPlansHandler) $this->hostingPlansHandler = new HostingPlans($this);
        return $this->hostingPlansHandler;
    }

    /**
     * @return Login
     */
    public function login(): Login
    {
        if (!$this->loginHandler) $this->loginHandler = new Login($this);
        return $this->loginHandler;
    }

}
