<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Collection;

/**
 * Class Conditions
 * @package Subapp\Sql\Ast\Condition
 */
class Conditions extends Collection
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClassName(Condition::class);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'condition.conditions';
    }
    
}