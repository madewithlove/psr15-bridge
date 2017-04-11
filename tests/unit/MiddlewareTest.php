<?php

namespace Madewithlove\Psr15\Bridge\Unit;

use Madewithlove\Psr15\Bridge\Middleware;
use Madewithlove\Psr15\Bridge\Stubs\Delegate;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MiddlewareTest extends TestCase
{
    /** @test */
    public function it_calls_the_delegate_process_method_as_callable()
    {
        // Arrange
        $request = $this->prophesize(ServerRequestInterface::class)->reveal();
        $response = $this->prophesize(ResponseInterface::class)->reveal();
        $delegate = new Delegate($response);
        $middleware = function (
            ServerRequestInterface $requestParam,
            ResponseInterface $responseParam,
            callable $next
        ) use ($request, $response) {
            $this->assertEquals($request, $requestParam);
            $this->assertEquals($response, $responseParam);

            return $next($requestParam, $responseParam);
        };

        $middleware = new Middleware($middleware, $response);

        // Act
        $response = $middleware->process($request, $delegate);

        // Assert
        $this->assertEquals($request, $delegate->getServerRequest());
        $this->assertEquals($response, $response);
    }
}
