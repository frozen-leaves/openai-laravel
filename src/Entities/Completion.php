<?php

namespace FrozenLeaves\OpenAILaravel\Entities;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class Completion extends AbstractEntity
{
    /**
     * @param DataCollection<int,CompletionChoice> $choices
     */
    public function __construct(
        public string $id,
        public string $model,
        #[DataCollectionOf(CompletionChoice::class)]
        public DataCollection $choices,
        public Usage $usage,
        public string|null $system_fingerprint
    ) {
    }

    public function getResponse(): ?string
    {
        $choice = $this->choices->first();

        if ($choice instanceof CompletionChoice) {
            return $choice->message->content;
        }

        return null;
    }
}
