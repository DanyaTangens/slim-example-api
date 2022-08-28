<?php

namespace App\Operation;

use Twig\Environment;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Index
{
    private Environment $view;

    public function __construct(Environment $view)
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $body = $this->view->render('index.twig');
        $response->getBody()->write($body);

        return $response;
    }
}