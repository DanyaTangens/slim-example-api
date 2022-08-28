<?php

namespace App\Operation;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HelloWorld
{
    use InjectJsonInResponseTrait;

    public function __invoke(Request $request, Response $response): Response
    {
        $data = [
            'Hello' => 'World'
        ];

        return $this->injectJson($response, $data);
    }
}