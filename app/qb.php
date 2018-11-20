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
$processor = new Processor($lexer);

$processor->setup(new DefaultParserSetup());
$processor->setLexer(new Lexer());

$recognizer = new Recognizer($processor, Recognizer::COMMON);

$node = new Node();
$node->setRecognizer($recognizer);

$qb = new QueryBuilder($node);
$qb->from('Users', 'U');
$qb->select('users.id uid, test.id', 'test.created dt');

//$qb->where('count(a.id) > 1 and b < 10');
//$qb->where('count(a.id)');
$qb->where('count(a.id) > 1 and b < 10');
$qb->where($node->in('users.id', [1, 2, 3]), false);


$c = $node->or(
    $node->eq(1, 2),
    $node->ge(1, 2)
);

$qb->join('user', 'U2', 'U.id = U2.id');

$qb->join('user', 'U2', 'U.id, U2.id');

$qb->having($c);

$qb->where($c, false);

$qb->group('a.id, u.id')->order('a.id asc, b.id desc, rand()', 'a.test desc');

$c->add($node->ne(1, 'u.id'));

$c->add($node->in('users.id', [1, 2, 3, 'Max(u.id)']));
//
//$conditions = $node->and(
//    $node->eq(1, 2),
//    $node->ne(3, true),
//    $node->eq(3, null),
//    $node->or(
//        $node->between('U.create', '2017', '2016'),
//        $node->isNull('U.updated')
//    )
//);
//
//$qb->and($conditions);

//var_dump($qb);

echo $renderer->render($qb->getAst()) . PHP_EOL;
//echo $renderer->render($conditions) . PHP_EOL;

