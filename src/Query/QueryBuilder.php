<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast\Condition\AbstractComparison;
use Subapp\Sql\Ast;
use Subapp\Sql\Exception\UnsupportedException;
use Subapp\Sql\Render\RendererInterface;

/**
 * Query Builder (Facade) based on AST
 *  - use Recognizer for parsing short-part sql
 *  - with compliance fluent interface
 *
 * Class QueryBuilder
 * @package Subapp\Sql\Query
 */
class QueryBuilder
{
    
    public const SELECT = 1;
    public const DELETE = 2;
    public const UPDATE = 4;
    
    public const STATE_DIRTY = 0;
    public const STATE_CLEAN = 1;
    
    /**
     * @var NodeBuilder
     */
    private $nodeBuilder;
    
    /**
     * @var integer
     */
    private $state = QueryBuilder::STATE_CLEAN;
    
    /**
     * @var integer
     */
    private $type = QueryBuilder::SELECT;
    
    /**
     * @var Ast\Root
     */
    private $root;
    
    /**
     * QueryBuilder constructor.
     * @param NodeBuilder $nodeBuilder
     */
    public function __construct(NodeBuilder $nodeBuilder)
    {
        $this->nodeBuilder = $nodeBuilder;
        $this->root = new Ast\Root();
    }
    
    /**
     * @return $this
     */
    public function select($select, $alias = null)
    {
        $this->type = QueryBuilder::SELECT;
        
        $ast = $this->getNodeBuilder()->recognize($select);
        
        $variable = new Ast\Variable($ast, new Ast\Identifier($alias));
        
        var_dump($variable);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function delete()
    {
        $this->type = QueryBuilder::DELETE;
    
        return $this;
    }
    
    /**
     * @return $this
     */
    public function update()
    {
        $this->type = QueryBuilder::UPDATE;
    
        return $this;
    }
    
    /**
     *
     */
    public function where()
    {
    
    }
    
    /**
     * @param AbstractComparison $comparison
     * @return $this
     */
    public function and(AbstractComparison $comparison)
    {
        $this->root->getWhere()->append(new Ast\Condition\Term\ANDTerm($comparison));
        
        return $this;
    }
    
    public function or()
    {
    
    }
    
    public function xor()
    {
    
    }
    
    public function in()
    {
    
    }
    
    public function between()
    {
    
    }
    
    public function like()
    {
    
    }
    
    public function isNull()
    {
    
    }
    
    /**
     * @return Ast\Stmt\Delete|Ast\Stmt\Select|Ast\Stmt\Update
     * @throws UnsupportedException
     */
    public function getAstNode()
    {
        /** @var Ast\Stmt\Select|Ast\Stmt\Delete|Ast\Stmt\Update $ast */
        $ast = null;
        
        switch ($this->type) {
            case QueryBuilder::SELECT:
                $ast = new Ast\Stmt\Select();
                break;
            case QueryBuilder::DELETE:
                $ast = new Ast\Stmt\Delete();
                break;
            case QueryBuilder::UPDATE:
                $ast = new Ast\Stmt\Update();
                break;
            default:
                throw new UnsupportedException(sprintf('Cannot create AST node for type: "%s"',
                    $this->getType()));
        }
    
        $ast->setRoot($this->root);
        
        return $ast;
    }
    
    /**
     * @param RendererInterface $renderer
     * @return string
     */
    public function getQuery(RendererInterface $renderer)
    {
        return $renderer->render($this->getAstNode());
    }
    
    
    
    /**
     * @return NodeBuilder
     */
    public function getNodeBuilder()
    {
        return $this->nodeBuilder;
    }
    
    /**
     * Alias: $this->getNodeBuilder(): Query\NodeBuilder
     *
     * @return NodeBuilder
     */
    public function node()
    {
        return $this->getNodeBuilder();
    }
    
    /**
     * @return Ast\Root
     */
    public function getRoot()
    {
        return $this->root;
    }
    
    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    
    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
}