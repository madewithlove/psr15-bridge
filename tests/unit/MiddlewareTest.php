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
        $requestProphecy = $this->prophesize(ServerRequestInterface::class);
        $responseProphecy = $this->prophesize(ResponseInterface::class);
        $middleware = function (
            ServerRequestInterface $request,
            ResponseInterface $response,
            callable $next
        ) use ($requestProphecy, $responseProphecy) {
            $this->assertEquals($requestProphecy->reveal(), $request);
            $this->assertEquals($responseProphecy->reveal(), $response);

            return $next($request, $response);
        };

        $middleware = new Middleware($middleware, $responseProphecy->reveal());

        // Act
        $response = $middleware->process($requestProphecy->reveal(), new Delegate($responseProphecy->reveal()));

        // Assert
        $this->assertEquals($responseProphecy->reveal(), $response);
    }
}
