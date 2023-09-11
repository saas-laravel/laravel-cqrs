<?php

namespace Modules\Ai\Client;

use OpenAI;
use Exception;
use OpenAI\Client;
use Modules\Ai\Enums\AiContextRole;
use Modules\Ai\Exceptions\AiException;
use Modules\Ai\DataTransferObjects\AiResultDto;
use Modules\Ai\DataTransferObjects\AiCommandDto;
use Modules\Ai\DataTransferObjects\AiContextDto;

class OpenAiClient implements AiClient
{
    protected Client $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    public function generate(AiCommandDto $dto): AiResultDto
    {
        $context = $this->prepareContext($dto->context);

        try {
            $result = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    $this->createContextArray(
                        new AiContextDto(
                            content: $dto->identity,
                            role: AiContextRole::System,
                        )
                    ),
                    ...$context,
                    $this->createContextArray(
                        new AiContextDto(
                            content: $dto->prompt,
                            role: AiContextRole::User,
                        )
                    ),
                ]
            ]);

            $output = str($result['choices'][0]['message']['content'] ?? '')
                ->replace("\n",  ' ')
                ->ltrim('.')
                ->trim()
                ->trim('"')
                ->toString();

            return new AiResultDto(
                output: $output,
                tokens: $result['usage']['total_tokens'],
            );
        } catch (Exception $e) {
            report($e);
            throw AiException::unknownError();
        }
    }

    protected function prepareContext(array $contextList): array
    {
        $output = [];

        /** @var AiContextDto $context */
        foreach ($contextList as $context) {
            $output[] = $this->createContextArray($context);
        }

        return $output;
    }

    protected function createContextArray(AiContextDto $dto): array
    {
        return [
            'role' => $dto->role->value,
            'content' => $dto->content,
        ];
    }
}
