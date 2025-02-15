<?php

namespace FrozenLeaves\OpenAILaravel\Entities;

use FrozenLeaves\OpenAILaravel\Enums\Role;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

class Message extends AbstractEntity
{
    public function __construct(
        #[WithCast(EnumCast::class)]
        public Role $role,
        public string $content,
    ) {
    }
}
