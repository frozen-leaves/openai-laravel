<?php

namespace FrozenLeaves\OpenAILaravel;

use FrozenLeaves\OpenAILaravel\Entities\Error;
use FrozenLeaves\OpenAILaravel\Enums\ApiVersion;
use FrozenLeaves\OpenAILaravel\Enums\Model;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIConnectionException;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIException;
use FrozenLeaves\Support\Enums\ContentType;
use FrozenLeaves\Support\UrlBuilder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client
{
    private const string BASE_URL = 'https://api.openai.com/';

    private Model $model = Model::GPT_4o;

    public function __construct(
        private readonly string $accessToken,
        private readonly ApiVersion $apiVersion,
    ) {
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    private function request(): PendingRequest
    {
        return Http::withToken($this->accessToken)->timeout(60)->connectTimeout(10)->withHeaders([
            'Content-Type' => ContentType::JSON->value,
            'Accept' => ContentType::JSON->value,
        ]);
    }

    private function buildUrl(UrlBuilder $urlBuilder): string
    {
        return $urlBuilder->toUrl(self::BASE_URL . $this->apiVersion->value . '/');
    }

    /**
     * @throws OpenAIException|OpenAIConnectionException
     */
    public function get(UrlBuilder $urlBuilder, array $headers = []): array
    {
        try {
            $response = $this->request()->get($this->buildUrl($urlBuilder), $headers);
        } catch (ConnectionException $e) {
            throw new OpenAIConnectionException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->processResponse($response);
    }

    /**
     * @param array<string,mixed> $headers
     * @param array<string,mixed> $body
     * @throws OpenAIException|OpenAIConnectionException
     */
    public function post(UrlBuilder $urlBuilder, array $body = [], array $headers = []): array
    {
        //Add model to the body
        $body['model'] = $this->model->value;

        try {
            $response = $this->request()->withHeaders($headers)->post($this->buildUrl($urlBuilder), $body);
        } catch (ConnectionException $e) {
            throw new OpenAIConnectionException($e->getMessage(), $e->getCode(), $e);
        }


        return $this->processResponse($response);
    }

    /**
     * @throws OpenAIException
     */
    private function processResponse(Response $response): array
    {
        $json = $response->json();

        if (array_key_exists('error', $json)) {
            throw OpenAIException::createFromError(Error::from($json['error']));
        }

        return $json;
    }
}

