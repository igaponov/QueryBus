<?php

namespace QueryBus;

abstract class AbstractQueryBus implements QueryBus
{
    /**
     * Given a Command Type (ClassName) return an instance of
     * the service that is handling this command.
     *
     * @param string $commandType A Command Class name
     * @return object
     */
    abstract protected function getService($commandType);

    public function handle(Query $query)
    {
        $type = get_class($query);
        $service = $this->getService($type);
        $handler = new QueryInvocationHandler($service);
        return $handler->retrieve($query);
    }
}
