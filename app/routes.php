<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('servicio iniciado');
        return $response;
    });

    $app->post('/login', function (Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        //$response->getBody()->write($email);
       if ($email === 'user@example.com' && $password === 'qwerty123') {
            
            $response->getBody()->write(json_encode(['success' => true, 'token' => 'token1234']));
            
        } else {
            $response->getBody()->write(json_encode(['error' => 'Credenciales incorrectas', "code"=> 401]));
        }
        return $response;
    });
    $app->post('/set_data', function (Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        if ($data) {
            $response->getBody()->write(json_encode(['success' => true, 'message' => 'Gracias, tu informacion se guardo']));
        } else {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Error al guardar la informacion']));
        }
        return $response;
       
    });

};
