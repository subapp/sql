<?php

namespace Subapp\Sql\Dumper;

/**
 * Class DumperFacade
 * @package Subapp\Sql\Dumper
 */
class DumperFacade
{
    
    const JSON_DUMPER = JsonDumper::class;
    const YAML_DUMPER = YamlDumper::class;
    const INI_DUMPER  = IniDumper::class;
    
    /**
     * @var array|DumperInterface[]
     */
    private $dumpers = [];
    
    /**
     * DumperFacade constructor.
     */
    public function __construct()
    {
        $this->dumpers[self::JSON_DUMPER] = new JsonDumper();
        $this->dumpers[self::INI_DUMPER] = new IniDumper();
        $this->dumpers[self::YAML_DUMPER] = new YamlDumper();
    }
    
    /**
     * @return DumperInterface
     */
    public function getJsonDumper()
    {
        return $this->dumpers[self::JSON_DUMPER];
    }
    
    /**
     * @return DumperInterface
     */
    public function getIniDumper()
    {
        return $this->dumpers[self::INI_DUMPER];
    }
    
    /**
     * @return DumperInterface
     */
    public function getYamlDumper()
    {
        return $this->dumpers[self::YAML_DUMPER];
    }
    
}