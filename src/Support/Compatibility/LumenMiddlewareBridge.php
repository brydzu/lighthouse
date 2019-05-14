<?php

namespace Nuwave\Lighthouse\Support\Compatibility;

use Nuwave\Lighthouse\Support\Utils;
use Laravel\Lumen\Application;

class LumenMiddlewareBridge implements MiddlewareBridge
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getMiddleware(): array
    {
        $globalMiddleware = Utils::accessProtected($this->app, 'middleware', []);
        $routeMiddleware = Utils::accessProtected($this->app, 'routeMiddleware', []);
        return array_merge($globalMiddleware, $routeMiddleware);
    }

    public function getMiddlewareGroups(): array
    {
        return []; // Lumen doesn't have middleware groups
    }
}
