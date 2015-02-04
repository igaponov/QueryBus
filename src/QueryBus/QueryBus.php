<?php

namespace QueryBus;

interface QueryBus
{
    /**
     * @param Query $query
     * @return mixed
     */
    public function handle(Query $query);
}
