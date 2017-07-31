<?php

namespace Madewithlove\Psr15\Bridge\Stubs;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Delegate implements DelegateInterface
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getServerRequest()
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request)
    {
        $this->request = $request;

        return $this->response;
    }
}
