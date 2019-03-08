<?php

namespace Subapp\Sql\Common;

use Closure;
use Subapp\Collection\Collection as BaseCollection;

/**
 * Class Collection
 * @package Subapp\Sql\Common
 */
class Collection extends BaseCollection
{
    
    /**
     * @inheritdoc
     */
    public function map(Closure $closure, Closure $keys = null)
    {
        return new static(array_map($closure, $this->elements));
    }
    
    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->elements;
    }
    
}
