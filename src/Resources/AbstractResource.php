<?php

namespace FrozenLeaves\OpenAILaravel\Resources;

use FrozenLeaves\OpenAILaravel\Client;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIConnectionException;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIException;
use FrozenLeaves\Support\UrlBuilder;

abstract class AbstractResource
{
    public function __construct(
        private readonly Client $client,
    ) {
    }

    /**
     * @param array<string, mixed> $headers
     * @throws OpenAIException|OpenAIConnectionException
     */
    protected function get(UrlBuilder $urlBuilder, array $headers = []): array
    {
        return $this->client->get($urlBuilder, $headers);
    }

    /**
     * @param array<string, mixed> $headers
     * @param array<string, mixed> $body
     * @throws OpenAIException|OpenAIConnectionException
     */
    protected function post(UrlBuilder $urlBuilder, array $body = [], array $headers = []): array
    {
        return $this->client->post($urlBuilder, $body, $headers);
    }
}