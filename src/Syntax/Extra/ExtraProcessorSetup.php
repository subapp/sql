<?php

namespace Subapp\Sql\Syntax\Extra;

use Subapp\Sql\Syntax\ProcessorInterface;
use Subapp\Sql\Syntax\ProcessorSetupInterface;
use Subapp\Sql\Syntax\Extra\Parser;

/**
 * Class ExtraProcessorSetup
 * @package Subapp\Sql\Syntax\Extra
 */
class ExtraProcessorSetup implements ProcessorSetupInterface
{

    /**
     * @inheritDoc
     */
    public function setup(ProcessorInterface $processor)
    {
        // overwrite function parser
        $processor->add(new Parser\Func());

        // special function
        $processor->add(new Parser\Func\MatchAgainst());
    }

}