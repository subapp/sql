<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Collection;

/**
 * Class TermCollection
 * @package Subapp\Sql\Ast\Condition
 */
class TermCollection extends Collection
{
    
    /**
     * TermCollection constructor.
     * @param array $expressions
     */
    public function __construct($expressions = [])
    {
        parent::__construct($expressions);
        
        $this->setClassName(Term::class);
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'condition.term_collection';
    }
    
}