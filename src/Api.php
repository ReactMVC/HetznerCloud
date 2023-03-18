<?php

/*
HetznerCloud Api

A PHP library for interacting with Hetzner Cloud API
*/

namespace HetznerCloud;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Api
{
    private string $token;
    private GuzzleClient $client;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->client = new GuzzleClient([
            'base_uri' => 'https://api.hetzner.cloud/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json; charset=utf-8',
            ],
        ]);
    }

    public function createServer(array $data): ResponseInterface
    {
        return $this->post('servers', $data);
    }

    public function deleteServer(int $id): ResponseInterface
    {
        return $this->delete("servers/$id");
    }

    public function getServerData(int $id): ResponseInterface
    {
        return $this->get("servers/$id");
    }

    public function editServer(int $id, array $data): ResponseInterface
    {
        return $this->put("servers/$id", $data);
    }

    public function updateServer(int $id, array $data): ResponseInterface
    {
        return $this->patch("servers/$id", $data);
    }

    private function post(string $uri, array $data): ResponseInterface
    {
        try {
            return $this->client->post($uri, ['json' => $data]);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

    private function patch(string $uri, array $data): ResponseInterface
    {
        try {
            return $this->client->patch($uri, ['json' => $data]);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

    private function put(string $uri, array $data): ResponseInterface
    {
        try {
            return $this->client->put($uri, ['json' => $data]);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

    private function get(string $uri): ResponseInterface
    {
        try {
            return $this->client->get($uri);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

    private function delete(string $uri): ResponseInterface
    {
        try {
            return $this->client->delete($uri);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }
}