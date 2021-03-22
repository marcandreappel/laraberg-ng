<?php
declare(strict_types=1);

namespace MarcAndreAppel\LarabergNG\Events;

use Illuminate\Queue\SerializesModels;

use MarcAndreAppel\LarabergNG\Models\Content;

class ContentRendered
{
    use SerializesModels;

    public Content $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }
}

