<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();
$response = new Response();

$routes = new Routing\RouteCollection();
//user/done
$routes->add('createUser', new Routing\Route('/users/create', ['_controller' => 'Tayara\Controller\Users::createUser'],[],[],'',[],['POST']));
$routes->add('getUser', new Routing\Route('/users/{id}', ['id' => null, '_controller' => 'Tayara\Controller\Users::getUser'], [],[],null,[],['GET']));
//user/still
$routes->add('updateUser', new Routing\Route('/users/Update/{id}', ['id' => null, '_controller' => 'Tayara\Controller\Users::updateUser'], [],[],null,[],['put']));

//annonces/done
$routes->add('getAll', new Routing\Route('/annonces',['_controller' => 'Tayara\Controller\annonces::getAll'], [],[],'',[],['GET']));
$routes->add('create', new Routing\Route('/annonces/create', ['_controller' => 'Tayara\Controller\annonces::create'],[],[],'',[],['POST']));
$routes->add('getAd', new Routing\Route('/annonces/{id}',['id'=>null, '_controller'=>'Tayara\Controller\annonces::getAd',[],[],null,[],['GET']]));
$routes->add('deleteAd', new Routing\Route('/annonces/delete/{id}',['id'=>null, '_controller'=>'Tayara\Controller\annonces::deleteAd',[],[],null,[],['DELETE']]));
//annonces/still
$routes->add('UpdateAd', new Routing\Route('/annonces/update/{id}',['id'=>null, '_controller'=>'Tayara\Controller\annonces::UpdateAd',[],[],null,[],['PATCH']]));
//categorie/done
$routes->add('getAllCategorie', new Routing\Route('/categories',['_controller' => 'Tayara\Controller\categories::getAllCategorie'], [],[],null,[],['GET']));


$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response($exception, 500);
}


$response->send();


/*
GET http://localhost/api/v1/users/  :: All users
GET http://localhost/api/v1/users/{12345}   : Get user with ID : 12345
POST http://localhost/api/v1/users/  :: create a new user
PUT http://localhost/api/v1/users/{12345}  :: Update a user with ID : 12345
DELETE http://localhost/api/v1/users/{12345} :: Delete user with ID : 12345

http://localhost/api/v1/annonces/

http://localhost/api/v1/types/

*/