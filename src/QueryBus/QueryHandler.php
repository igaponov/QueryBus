<?php

namespace QueryBus;

interface QueryHandler
{
    /**
     * @param Query $query
     * @return mixed
     */
    public function retrieve(Query $query);
}
