<?php

namespace FrozenLeaves\OpenAILaravel\Resources;

use FrozenLeaves\OpenAILaravel\Entities\Completion;
use FrozenLeaves\OpenAILaravel\Entities\Message;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIConnectionException;
use FrozenLeaves\OpenAILaravel\Exceptions\OpenAIException;
use FrozenLeaves\Support\UrlBuilder;
use Illuminate\Support\Collection;

class Completions extends AbstractResource
{
    private const string RESOURCE_URL = 'chat/completions';

    /**
     * @throws OpenAIException|OpenAIConnectionException
     */
    public function find(string $completionId): Completion
    {
        return Completion::from($this->get(UrlBuilder::create(self::RESOURCE_URL . '/' . $completionId)));
    }

    /**
     * @param Collection<int, Message> $messages
     * @throws OpenAIException|OpenAIConnectionException
     */
    public function create(Collection $messages): Completion
    {
        return Completion::from($this->post(UrlBuilder::create(self::RESOURCE_URL), [
            'messages' => $messages->toArray(),
        ]));
    }
}