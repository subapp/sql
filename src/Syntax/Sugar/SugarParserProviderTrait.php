<?php

namespace Subapp\Sql\Syntax\Sugar;

use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Trait SugarParserProviderTrait
 * @package Subapp\Sql\Syntax\Sugar
 */
trait SugarParserProviderTrait
{

    /**
     * @param string $name
     * @param ProcessorInterface $processor
     * @return ParserInterface
     */
    public function getFuncParser($name, ProcessorInterface $processor)
    {
        return $processor->getParser($this->completeName($name));
    }

    /**
     * @param string $name
     * @param ProcessorInterface $processor
     * @return boolean
     */
    public function hasFuncParser($name, ProcessorInterface $processor)
    {
        return $processor->has($this->completeName($name));
    }

    /**
     * @param string $name
     * @return string
     */
    public function completeName($name)
    {
        return sprintf('SUGAR_FUNC_%s', strtoupper($name));
    }

}