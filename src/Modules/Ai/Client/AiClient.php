<?php

namespace Modules\Ai\Client;

use Modules\Ai\DataTransferObjects\AiResultDto;
use Modules\Ai\DataTransferObjects\AiCommandDto;

interface AiClient
{

    public function generate(AiCommandDto $dto): AiResultDto;

}
