<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\Condition\Conditions;

/**
 * Class Having
 * @package Subapp\Sql\Ast
 */
class Having extends Conditions
{

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'stmt.having';
    }

}