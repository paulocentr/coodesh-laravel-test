<?php

namespace App\Integrations\AwesomeApi;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class CurrenciesBaseRequest
{

    protected $apiUrl = 'https://economia.awesomeapi.com.br/json';

    /**
     * Creates the request with specified headers
     *
     * @param array $headers
     * @return PendingRequest
     */
    protected function makeRequest(array $headers = []): PendingRequest
    {
        return Http::withHeaders($headers);
    }

    /**
     * Performs a get request
     *
     * @param string $action
     * @param array $data
     * @param array $headers
     * @return Response
     */
    protected function get(string $action, array $data = [], array $headers = []): Response
    {
        return $this->makeRequest($headers)->get($this->apiUrl . $action, $data);
    }

    /**
     * Performs a post request
     *
     * @param string $action
     * @param array $data
     * @param array $headers
     * @return Response
     */
    protected function post(string $action, array $data = [], array $headers = []): Response
    {
        return $this->makeRequest($headers)->post($this->apiUrl . $action, $data);
    }

    /**
     * Performs a put request
     *
     * @param string $action
     * @param array $data
     * @param array $headers
     * @return Response
     */
    protected function put(string $action, array $data = [], array $headers = []): Response
    {
        return $this->makeRequest($headers)->put($this->apiUrl . $action, $data);
    }

    /**
     * Performs a delete request
     *
     * @param string $action
     * @param array $data
     * @param array $headers
     * @return Response
     */
    protected function delete(string $action, array $data = [], array $headers = []): Response
    {
        return $this->makeRequest($headers)->delete($this->apiUrl . $action, $data);
    }
}
