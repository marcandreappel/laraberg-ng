<?php
declare(strict_types=1);

namespace MarcAndreAppel\LarabergNG\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MarcAndreAppel\LarabergNG\Helpers\EmbedHelper;

class OEmbedController extends ApplicationController
{
    public function __invoke(Request $request): Response
    {
        $embed = EmbedHelper::create($request->get('url'));
        $data = EmbedHelper::serialize($embed);

        if ($data['html'] == null) {
            return $this->notFound();
        }

        return $this->ok($data);
    }
}
