<?php

use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\MySQLPlatform;
use Subapp\Sql\Query\Node;
use Subapp\Sql\Query\QueryBuilder;
use Subapp\Sql\Query\Recognizer;
use Subapp\Sql\Converter\DefaultConverterSetup;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Syntax\Common\DefaultProcessorSetup;
use Subapp\Sql\Syntax\Processor;
use Subapp\Sql\Syntax\Sugar\SugarProcessorSetup;

include_once __DIR__ . '/../vendor/autoload.php';

$facade = new \Subapp\Sql\Sql();

$provider = new Converter();
$provider->setup(new DefaultConverterSetup());

$lexer = new Lexer();
$processor = new Processor($lexer);

$processor->setup(new DefaultProcessorSetup());
$processor->setup(new SugarProcessorSetup());
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

$qb->join('users2', 'U2', 'U2.id != U.id');

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

$converter = $facade->getConverter();

$yaml = file_get_contents(__DIR__ . '/dump1.yaml');
$yamlData = $facade->getDumper()->getYamlDumper()->parse($yaml);

var_dump($converter->toSql($converter->toNode($yamlData)));

echo $provider->toSql($qb->getAst()) . PHP_EOL;

//echo $facade->getDumper()->getYamlDumper()->dump($facade->getConverter()->toArray($qb->getAst()));

$array = $provider->toArray($qb->getAst());

file_put_contents(__DIR__ . '/select.json', json_encode($array, 128));

$node = $provider->toNode($array);
echo $provider->toSql($node) . PHP_EOL;

//var_dump(
//    json_encode()
//);
//echo $converter->render($conditions) . PHP_EOL;

