<?php

namespace FrozenLeaves\OpenAILaravel\Entities;

use Spatie\LaravelData\Data;

class Error extends Data
{
    public function __construct(
        public string $type,
        public string $code,
        public string $message,
        public ?string $param,
        public string $event_id,
    ) {
    }
}