<?php

namespace Subapp\Sql\Syntax\Sugar;

use Subapp\Sql\Syntax\ProcessorInterface;
use Subapp\Sql\Syntax\ProcessorSetupInterface;
use Subapp\Sql\Syntax\Sugar\Parser;

/**
 * Class SugarProcessorSetup
 * @package Subapp\Sql\Syntax\Sugar
 */
class SugarProcessorSetup implements ProcessorSetupInterface
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