<?php

declare(strict_types=1);

namespace App;

use App\Exception\UrlNotFound;
use App\Http\Request;
use App\Http\Response;
use App\Router\Router;

/**
 * Class Application
 * @package App
 */
class Application
{
    /**
     * @var string
     */
    private string $rootDirectory;

    /**
     * @var Router
     */
    private Router $router;

    /**
     * @var Autoloader
     */
    private Autoloader $autoloader;

    /**
     * Application constructor.
     * @param string $rootDirectory
     */
    public function __construct(string $rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;
        $this->autoloader = new Autoloader($this->rootDirectory . '/src');
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function bootstrap(): void
    {
        $this->autoloader->registerAutoloader();

        $this->router = new Router($this->rootDirectory . '/config');
        $this->router->loadRoutes();
    }

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $request = new Request();
            $controllerDescriptor = $this->router->route($request);

            $response = $this->runController($controllerDescriptor, $request);

            $this->send($response);
        } catch (UrlNotFound $exception){
            $this->send(
                new Response($exception->getMessage(), Response::HTTP_BAD_REQUEST)
            );
        } catch (\Exception $exception) {
            $this->send(
                new Response('<h2>Error</h2>h2>' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }
    }

    /**
     * @param array $controllerDescriptor
     * @param Request $request
     * @return Response
     */
    private function runController(array $controllerDescriptor, Request $request): Response
    {
       $className = 'App\Controller\\' . $controllerDescriptor['controller'];
       $actionName = $controllerDescriptor['action'];

       $controller = new $className($this->rootDirectory . '/templates');

       return $controller->{$actionName}($request);
    }

    /**
     * @param Response $response
     */
    private function send(Response $response): void
    {
        if (headers_sent()) {
            return;
        }

        foreach ($response->getHeaders() as $name => $value) {
            header($name . ':' . $value, false);
        }

        header(
            sprintf(
                'HTTP/%s %s %s',
                $response->getVersion(),
                $response->getStatusCode(),
                $response->getStatusText(),
            )
        );

        echo $response->getContent();
    }
}