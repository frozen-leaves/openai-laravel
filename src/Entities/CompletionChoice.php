<?php

namespace FrozenLeaves\OpenAILaravel\Entities;

class CompletionChoice extends AbstractEntity
{
    public function __construct(
        public string $index,
        public Message $message,
        public string $finish_reason,
    ) {
    }
}
