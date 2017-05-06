<?php

namespace Madewithlove\Psr15\Bridge;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;

class Middleware implements MiddlewareInterface
{
    /**
     * @var callable
     */
    private $middleware;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param callable $middleware
     * @param ResponseInterface $response
     */
    public function __construct(callable $middleware, ResponseInterface $response)
    {
        $this->middleware = $middleware;
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return call_user_func_array($this->middleware, [$request, $this->response, [$delegate, 'process']]);
    }
}
