<?php

namespace QueryBus;

class DefaultQuery implements Query
{
    public function __construct(array $data = array())
    {
        foreach ($data as $key => $value) {
            if (!property_exists($this, $key)) {
                $parts = explode("\\", get_class($this));
                $command = str_replace("Query", "", end($parts));

                $message = sprintf('Property "%s" is not a valid property on command "%s".', $key, $command);
                throw new \RuntimeException($message);
            }

            $this->$key = $value;
        }
    }
}
