<?php

use App\Handler\DefaultErrorHandler;
use App\Operation\Index;
use DevCoder\DotEnv;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use App\Operation\HelloWorld;

require __DIR__ . '\..\vendor\autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions('config/Container.php');
(new DotEnv(__DIR__ . '\..\.env'))->load();

$container = $builder->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(DefaultErrorHandler::class);

$app->addBodyParsingMiddleware();

$app->get('/', Index::class);

$app->group('/api', function (RouteCollectorProxy $app) {
    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('', HelloWorld::class);
    });
});

$app->run();