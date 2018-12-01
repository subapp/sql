<?php

namespace Subapp\Sql\Syntax\Extra;

use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Trait ExtraParserProviderTrait
 * @package Subapp\Sql\Syntax\Extra
 */
trait ExtraParserProviderTrait
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
        return sprintf('EXTRA_FUNC_%s', strtoupper($name));
    }

}