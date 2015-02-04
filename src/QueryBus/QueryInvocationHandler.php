<?php

namespace QueryBus;

use RuntimeException;

class QueryInvocationHandler implements QueryHandler
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function retrieve(Query $query)
    {
        $method  = $this->getHandlerMethodName($query);

        if (!method_exists($this->service, $method)) {
            $message = sprintf("Service %s has no method %s to handle command.", get_class($this->service), $method);
            throw new RuntimeException($message);
        }

        return $this->service->$method($query);
    }

    public function getHandlerMethodName(Query $query)
    {
        $parts = explode("\\", get_class($query));

        return str_replace("Query", "", lcfirst(end($parts)));
    }
}
