<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OpenAIService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(ParameterBagInterface $params)
    {
        $this->client = HttpClient::create();
        $this->apiKey = $params->get('openai.api_key');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function uploadFile(string $filePath, string $purpose = 'user_data'): array
    {
        $response = $this->client->request('POST', 'https://api.openai.com/v1/files', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'body' => [
                'purpose' => $purpose,
                'file' => fopen($filePath, 'r'),
            ],
        ]);

        return $response->toArray();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function queryOpenAI(array $data): array
    {
        $response = $this->client->request('POST', 'https://api.openai.com/v1/responses', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return $response->toArray();
    }
}