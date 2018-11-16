<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast;
use Subapp\Sql\Exception\QueryExpression;
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
     * @var Node
     */
    private $node;
    
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
     * @param Node $nodeBuilder
     */
    public function __construct(Node $nodeBuilder)
    {
        $this->node = $nodeBuilder;
        $this->root = new Ast\Root();
    }

    /**
     * @param string|Ast\ExpressionInterface ...$variables
     * @return $this
     */
    public function select(...$variables)
    {
        $this->type = QueryBuilder::SELECT;

        $this->root->setArguments($this->node->recognize($variables));
        
        return $this;
    }

    /**
     * @param $source
     * @param $alias
     * @return $this
     */
    public function from($source, $alias)
    {
        $variable = $this->node->variable($source, $alias);

        $this->root->setFrom(new Ast\Stmt\From($variable));

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
     * @param string|Ast\Condition\AbstractComparison $e
     * @param boolean $append
     * @return $this
     * @throws QueryExpression
     */
    public function where($e, $append = false)
    {
        $where = $this->root->where();

        $conditions = $this->node()->recognize($e);
        if ($conditions instanceof Ast\Condition\AbstractComparison) {
            $conditions = $this->node()->conditions(null, $conditions);
        }
        
        if (!($conditions instanceof Ast\Condition\Conditions)) {
            throw new QueryExpression(sprintf(
                'Method $qb->where(); accept either conditional-string or Object(Ast\Condition\Conditions) expression but "%s" passed',
                    get_class($conditions)));
        }
        
        $where->asBatch($conditions->toArray());

        // remove logical operator from last-one condition
        // to avoid: (a > 1) AND (b < 2) AND
        $where->offsetGet($where->count() - 1)->setOperator(null);
        
        return $this;
    }
    
    /**
     * @param Ast\ExpressionInterface|string $comparison
     * @return $this
     */
    public function and($comparison)
    {
        var_dump($this->getNode()->and($comparison)); die;
        $this->getRoot()->getWhere()->append($this->getNode()->and($comparison));

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
    public function getAst()
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
        return $renderer->render($this->getAst());
    }
    
    
    /**
     * @return Node
     */
    public function getNode()
    {
        return $this->node;
    }
    
    /**
     * Alias: $this->getNodeBuilder(): Query\NodeBuilder
     *
     * @return Node
     */
    public function node()
    {
        return $this->getNode();
    }
    
    /**
     * @return Ast\Root
     */
    public function getRoot()
    {
        return $this->root;
    }
    
    /**
     * @param Ast\Root $root
     */
    public function setRoot(Ast\Root $root)
    {
        $this->root = $root;
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