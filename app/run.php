<?php

use Subapp\Sql\Ast\Condition\Operator;
use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\MathOperator;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Recognizer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = 'Select';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new Lexer();

$lexer->tokenize($sql);

echo PHP_EOL;

//die(var_dump($lexer));

//echo "====== SQL ======\n";
//echo $sql;

echo "\n====== Tokens ======\n";

$counter = 0;

/** @var \Subapp\Lexer\TokenInterface $token */
//foreach ($lexer as $token) {
//    echo sprintf('%s("%s")%s', $lexer->getConstantName($token->getType()), $token->getToken(), "\t")
//        . ($counter++ % 5 === 0 ? PHP_EOL : null);
//}


echo "Tokens: " . count($lexer->getTokens()) . PHP_EOL;

//var_dump($lexer);

$lexer->rewind();

$processor = new \Subapp\Sql\Syntax\Processor($lexer);
$processor->setup(new \Subapp\Sql\Syntax\Common\DefaultProcessorSetup());
$processor->setup(new \Subapp\Sql\Syntax\Extra\ExtraProcessorSetup());

try {
    /** @var \Subapp\Sql\Ast\Stmt\Select $ast */
    $time = microtime(true);
    $ast = $processor->parse();
    $parseTime = microtime(true) - $time;

//    var_dump($select);
    
    $renderer = new \Subapp\Sql\Converter\Converter();
    $renderer->setup(new \Subapp\Sql\Converter\DefaultConverterSetup());
    
    $processor->setLexer(new Lexer());
    $recognizer = new Recognizer($processor, Recognizer::COMMON);
    
    $node = new \Subapp\Sql\Query\Node();
    $node->setRecognizer($recognizer);
    
    $qb = new \Subapp\Sql\Query\QueryBuilder($node);
    $qb->insert('users');
    $qb->fields('test', 'id', 'created');
    $qb->values([
        [1, 2, 3],
        [3, 2, 1],
    ]);
    $qb->values([
        ['Count(a)', 123, 'Date("2019-01-01")'],
        ['Count(b)', 321, 'Date("2019-01-01")'],
        ['Sum(z)', 111, 'Date("2019-01-01")'],
    ]);
    
    echo $renderer->toSql($qb->getAst());
    die;
    
//    $qb->setRoot($ast->getRoot());

//    var_dump($ast);

//    $qb->crossJoin('asd', 'aa', 'aa.id');
    
    $time = microtime(true);
    $class = get_class($ast);
//    file_put_contents(__DIR__ . '/select.json', json_encode($renderer->toArray($ast), 128));
    
    echo "\n====== [{$class}] AST Converter ======\n";
//    var_dump($ast);
    echo $renderer->toSql($ast);
    $array = $renderer->toArray($ast);
    file_put_contents(__DIR__ . '/select.json', json_encode($array, 128));
    echo PHP_EOL;
    echo $renderer->toSql($renderer->toNode($array)) . PHP_EOL;

//    echo json_encode($renderer->toArray($ast), 128);

//    echo ($renderer->toSql($select) == $sql) ? 'Equal' : 'Not';
//    echo PHP_EOL;
//    echo sprintf('Converter: %s', microtime(true) - $time);
//    echo PHP_EOL;
//    echo sprintf('Parser: %s', $parseTime);
//    echo PHP_EOL;
//
//
//
//    /** @var Conditions $conditions */
//    $recognized = $recognizer->recognize('Upper(u.name) > 1 + 1');
//
//    $conditions = $node->and(
//        $node->eq(1, 2),
//        $recognized,
////        $node->ge(2, 'count(Distinct U.id)'),
//        $node->ne(3, 4),
////        $node->in('U.id', [1, 2, 3, '(select id from users u limit 1)', 5, 6, 7, 'sum(U.id)'], true),
//        $node->or(
////            '(u.id + 1 * 2) > sum(Distinct U.cnt)',
//            $node->between('U.create', '2017', '2016'),
//            $node->isNull('U.updated')
//        )
//    );

    echo "\n\n\n";
    
} catch (\Throwable $exception) {
    die(sprintf("\n-----------------\n[%s]: %s\n%s\n-----------------\n",
        get_class($exception), $exception->getMessage(), $exception->getTraceAsString()));
}