<?php

namespace FrozenLeaves\OpenAILaravel\Entities;

class Usage extends AbstractEntity
{
    public function __construct(
        public int $prompt_tokens,
        public int $completion_tokens,
        public int $total_tokens,
    ) {
    }
}
