<?php

namespace Modules\Ai\DataTransferObjects;

use Modules\Ai\Enums\AiContextRole;

class AiCommandDto
{
    /**
     * @param string $prompt
     * @param string $identity
     * @param AiContextRole[] $context
     */
    public function __construct(
        public readonly string $prompt,
        public readonly string $identity,
        public readonly array $context = [],
    )
    {

    }
}
