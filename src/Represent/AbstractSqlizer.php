<?php

namespace Subapp\Sql\Represent;

use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractRepresent
 * @package Subapp\Sql\Represent
 */
abstract class AbstractSqlizer implements SqlizerInterface
{
    
    use ClassNameTrait;
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->createName(static::class);
    }
    
}