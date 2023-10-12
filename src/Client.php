<?php

namespace Fuziion\HttpApi;

use Fuziion\HttpApi\Data\DataObject;

class Client
{
    public function __construct(
        protected readonly string $apiKey,
        protected readonly string $apiUrl,
    )
    {
    }

    /**
     * @param string $endpoint
     * @param array $headers
     * @return DataObject|null
     */
    public function get(string $endpoint, array $headers = []): ?DataObject
    {
        $request = $this->prepareRequest($endpoint, $headers);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request['url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request['headers']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return null;
        }

        curl_close($ch);

        return new DataObject(json_decode($response, true));
    }

    /**
     * @param string $endpoint
     * @param array $headers
     * @return array
     */
    private function prepareRequest(string $endpoint, array $headers = []): array
    {
        $url = rtrim($this->apiUrl, '/') . '/' . ltrim($endpoint, '/');
        $headers = array_merge($headers, [
            'Content-Type: application/json',
        ]);

        if (!empty($this->apiKey)) {
            $headers[] = 'Authorization: Bearer ' . $this->apiKey;
        }

        return [
            'url' => $url,
            'headers' => $headers,
        ];
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @param array $headers
     * @return DataObject|null
     */
    public function post(string $endpoint, array $data, array $headers = []): ?DataObject
    {
        $request = $this->prepareRequest($endpoint, $headers);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request['url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request['headers']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return null;
        }

        curl_close($ch);

        return new DataObject(json_decode($response, true));
    }
}
