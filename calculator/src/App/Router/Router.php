<?php

declare(strict_types=1);

namespace App\Router;

use App\Exception\UrlNotFound;
use App\Http\Request;

/**
 * Class Router
 * @package App\Router
 */
class Router
{
    private string $configDirectory;
    private array $routes;

    /**
     * Router constructor.
     * @param string $configDirectory
     */
    public function __construct(string $configDirectory)
    {
        $this->routes = [];
        $this->configDirectory = $configDirectory;
    }

    /**
     * @throws \Exception
     */
    public function loadRoutes(): void
    {
        $path = $this->configDirectory . DIRECTORY_SEPARATOR . 'routes.php';

        if (!file_exists($path)) {
            throw new \Exception('Config routes not found');
        }

        $this->routes = include $path;
    }

    /**
     * @param Request $request
     * @return array
     * @throws UrlNotFound
     */
    public function route(Request $request): array
    {
        $url = $request->getUrl();
        $method = $request->getMethod();

        if (!isset($this->routes[$url])) {
            throw new UrlNotFound('Page not found');
        }

        $route = $this->routes[$url];

        if (!isset($route[$method])) {
            throw new UrlNotFound('Page not found');
        }

        return $route[$method];
    }
}