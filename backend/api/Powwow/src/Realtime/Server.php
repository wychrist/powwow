<?php

namespace Powwow\Realtime;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Server
{

    protected string $appKey;
    protected string $appSecret;
    protected string $appId;
    protected Client $client;
    protected $authVersion;
    protected $serverUrl;

    public function __construct(
        string $appId,
        string $appKey,
        string $appSecret,
        string $serverUrl,
        string $authVersion = '1.0'
    ) {
        $this->appId = $appId;
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->authVersion = $authVersion;
        $this->serverUrl = $serverUrl;

        $this->client = new Client();
    }

    public function getKey(): string
    {
        return $this->appKey;
    }

    public function getSecret(): string
    {
        return $this->appSecret;
    }

    public function getId(): string
    {
        return $this->appId;
    }


    public function authenticate(
        string $socketId,
        string $channelName,
        array $data = []
    ): array {

        if (strstr($channelName, 'presence-') !== false) {
            $channelData = json_encode($data);
            $signature = hash_hmac('sha256', "{$socketId}:{$channelName}:{$channelData}", $this->appSecret);
            return [
                'auth' => "{$this->appKey}:{$signature}",
                'channel_data' => $channelData
            ];
        } else {
            $signature = hash_hmac('sha256', "{$socketId}:${channelName}", $this->appSecret);
            return [
                'auth' => "{$this->appKey}:{$signature}"
            ];
        }
    }

    public function get(string $info): ResponseInterface
    {
        $timestamp = time() * 1000;
        $bodyMd5 = '';

        $str = "GET\n/apps/{$this->appId}/events\nauth_key={$this->appKey}&auth_timestamp={$timestamp}&auth_version={$this->authVersion}&body_md5={$bodyMd5}";
        $hash = '&auth_signature=' . hash_hmac('sha256', $str, $this->appSecret);
        $query = "auth_key={$this->appKey}&auth_timestamp={$timestamp}&auth_version={$this->authVersion}&body_md5={$bodyMd5}&{$hash}";

        $url = "{$this->serverUrl}/apps/{$this->appId}/{$info}?{$query}";
        return $this->client->request('GET', $url);
    }

    public function trigger(Payload $payload): ResponseInterface
    {
        return $this->postRequest($this->buildPayload($payload));
    }


    public function makePayload(array $channels, string $event, array $data, ?string $socketId = null, array $info = []): Payload
    {
        return new Payload($channels, $event, $data, $socketId, $info);
    }

    public function batchTrigger(Payload ...$payload): ResponseInterface
    {
        $batch = [];
        foreach ($payload as $aPayload) {
            $batch[] = $this->buildPayload($aPayload);
        }

        return $this->postRequest(['batch' => $batch], 'batch_events');
    }

    protected function postRequest(array $payload, string $endpoint = 'events'): ResponseInterface
    {
        return $this->client->request(
            'POST',
            "{$this->serverUrl}/apps/{$this->appId}/{$endpoint}",
            ['json' => $payload]
        );
    }
    protected function buildPayload(Payload $payload): array
    {
        $data = json_encode($payload->getData());
        $bodyMd5 = md5($data);
        $timestamp = time() * 1000;
        $authVersion = $this->authVersion;

        $str = "POST\n/apps/{$this->appId}/events\nauth_key={$this->appKey}&auth_timestamp={$timestamp}&auth_version={$authVersion}&body_md5={$bodyMd5}";

        return [
            'event' => $payload->getEvent(),
            'channels' => $payload->getChannels(),
            'data' => $data,
            'auth_key' => $this->appKey,
            'auth_timestamp' => $timestamp,
            'auth_version' => $authVersion,
            'body_md5' => $bodyMd5,
            'auth_signature' =>  hash_hmac('sha256', $str, $this->appSecret),
            'socket_id' => $payload->getSocketId(),
        ] + $payload->getParams();
    }
}
