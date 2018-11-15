<?php

use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\MySQLPlatform;
use Subapp\Sql\Query\Node;
use Subapp\Sql\Query\QueryBuilder;
use Subapp\Sql\Query\Recognizer;
use Subapp\Sql\Render\Common\DefaultRendererSetup;
use Subapp\Sql\Render\Renderer;
use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\Processor;

include_once __DIR__ . '/../vendor/autoload.php';

$renderer = new Renderer();
$renderer->setup(new DefaultRendererSetup());

$lexer = new Lexer();
$processor = new Processor($lexer, new MySQLPlatform());

$processor->setup(new DefaultParserSetup());
$processor->setLexer(new Lexer());

$recognizer = new Recognizer($processor, Recognizer::DIFFICULT);

$node = new Node();
$node->setRecognizer($recognizer);

$qb = new QueryBuilder($node);

$qb->select('users', 'uid');

$qb->and($node->in('users.id', [1, 2, 3]));

$conditions = $node->and(
    $node->eq(1, 2),
    $node->ne(3, true),
    $node->eq(3, null),
    $node->or(
        $node->between('U.create', '2017', '2016'),
        $node->isNull('U.updated')
    )
);

$qb->and($conditions);

echo $renderer->render($qb->getAstNode()) . PHP_EOL;
echo $renderer->render($conditions) . PHP_EOL;