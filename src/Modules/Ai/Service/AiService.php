<?php

namespace Modules\Ai\Service;

use Modules\Ai\Client\AiClient;
use Modules\Ai\DataTransferObjects\AiResultDto;
use Modules\Ai\DataTransferObjects\AiCommandDto;

class AiService
{

    public function __construct(
        protected AiClient $client
    ) {
    }

    public function generateGreeting(): AiResultDto
    {
        return $this->client->generate(
            new AiCommandDto(
                prompt: 'Generate a welcome message for John',
                identity: 'You are a helpful AI consultant called Bobby, your job is to create welcome messages.',
            )
        );
    }

}
