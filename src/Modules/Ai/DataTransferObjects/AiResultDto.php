<?php

namespace Modules\Ai\DataTransferObjects;

class AiResultDto
{

    public function __construct(
        public readonly string $output,
        public readonly int $tokens,
    )
    {

    }

}
