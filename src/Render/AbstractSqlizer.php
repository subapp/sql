<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractRepresent
 * @package Subapp\Sql\Render
 */
abstract class AbstractSqlizer implements SqlizerInterface
{
    
    use ClassNameTrait;
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getUnderscore(static::class);
    }
    
}