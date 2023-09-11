<?php

namespace Modules\Ai\Enums;

enum AiContextRole: string
{
    case System = 'system';
    case User = 'user';
    case Assistant = 'assistant';
}
