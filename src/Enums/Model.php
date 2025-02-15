<?php

namespace FrozenLeaves\OpenAILaravel\Enums;

enum Model: string
{
    case GPT_4o = 'gpt-4o';

    case GPT_4o_MINI = 'gpt-4o-mini';

    case GPT_o1 = 'o1';

    case GPT_o1_MINI = 'o1-mini';

    case GPT_o3_MINI = 'o3-mini';
}