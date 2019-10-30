<?php
declare(strict_types=1);

use App\Application\Actions\Gif\SearchGifAction;
use App\Application\Actions\Gif\RandomGifAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/v1', function (Group $group) {
        $group->get('/gifs/search', SearchGifAction::class);
        $group->get('/gifs/random', RandomGifAction::class);
    });
};
