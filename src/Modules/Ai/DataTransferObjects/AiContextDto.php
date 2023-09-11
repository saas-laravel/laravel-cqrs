<?php

namespace Modules\Ai\DataTransferObjects;

use Modules\Ai\Enums\AiContextRole;

class AiContextDto
{

    public function __construct(
        public readonly string $content,
        public readonly AiContextRole $role,
    )
    {

    }

}
