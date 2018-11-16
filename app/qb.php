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

$recognizer = new Recognizer($processor, Recognizer::COMMON);

$node = new Node();
$node->setRecognizer($recognizer);

/**
 * SELECT
 *  U.id,
 *  U.created,
 *  COUNT(DISTINCT U.ip) AS uniqueIP,
 *  NULLIF(U.updated, UPDATED_AT) AS BooleanValue
 * FROM
 *  (SELECT * FROM users) AS U
 * WHERE
 *  U.id BETWEEN 1 AND 1000 b < 10;
 */

$qb = new QueryBuilder($node);
$qb->from('(select * from users)', 'U');
$qb->select('U.id, U.created, Count(Distinct U.ip) uniqueIP', 'NullIf(U.updated, UPDATED_AT) As BooleanValue');

$qb->where('count(a.id) > 1 and b < 10');
$qb->and('U.id Between 1 And 1000');

//$qb->where($node->in('users.id', [1, 2, 3]));

//$qb->and($node->in('users.id', [1, 2, 3]));
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

echo $renderer->render($qb->getAst()) . PHP_EOL;
//echo $renderer->render($conditions) . PHP_EOL;