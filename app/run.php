<?php

use Subapp\Sql\Ast\Condition\Operator;
use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\MathOperator;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Recognizer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = 'Select1';

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
//    $parseTime = microtime(true) - $time;
    $renderer = new \Subapp\Sql\Converter\Converter();
    $renderer->setup(new \Subapp\Sql\Converter\DefaultConverterSetup());
//    $processor->setLexer(new Lexer());
//    $recognizer = new Recognizer($processor, Recognizer::COMMON);
//    $builder = new \Subapp\Sql\Query\Builder();
//    $builder->setRecognizer($recognizer);
//
//    $query = new \Subapp\Sql\Query\Query($builder);
//
//    $query->setConverter($renderer);
//
//    ////// Update
//    $query->update('users U')->delayed();
//    $query->sets([
//        'name' => 'John',
//        'date' => '2018-01-01',
//        'hits' => $builder->sql('sum(U.hit)')
//    ]);
//
//    $where = $builder->and(
//        $builder->or('U.id > 2', 'U.id < len(U.email)'),
//        $builder->or('U.id < 0', 'U.id > len(U.name)', $builder->eq('x', $builder->sql('len(x)')))
//    );
//
//    $query->where($where);
////    $query->where(null);
//
////    var_dump($query->getConverter()->toSql($query->getRoot()->getWhere()));
//
//    echo $query->getSql() . PHP_EOL;
//
//    ///////// Insert
//    $query->reset();
//
//    $query->insert('users U')->ignore();
//    $query->fields('U.name', 'created');
//    $query->values([
//        ['tedd', '2019-01-01'],
//    ]);
//    $query->values([
//        ['john', $builder->sql('now()')],
//        ['nedd', '2019-01-01'],
//    ]);
//
//    echo $renderer->toSql($query->getAst()) . PHP_EOL;
//
//    ////// Select
//    $query->reset();
//
//    $query->select('users')->noCache();
//    $query->columns('test', 'id', 'created', 'count(*) cnt');
//    $query->where('id = 1');
//
//    echo $query->getSql() . PHP_EOL;
//
//    ////// Delete
//    $query->reset();
//
//    $query->delete('users U')->quick();
//    $query->where(
//        $builder->or(
//            'U.id = 1',
//            $builder->ge('U.id', 1000),
//            $builder->ge('U.access',
//                $builder->sql('rand()'
//                )
//            ))
//    );
//    $query->limit(1);
//
//    echo $renderer->toSql($query->getAst()) . PHP_EOL;
//
//
////
////    $query->setRoot($ast->getRoot());
//
////    var_dump($ast);
//
////    $query->crossJoin('asd', 'aa', 'aa.id');
//
//    $time = microtime(true);
    $class = get_class($ast);
////    file_put_contents(__DIR__ . '/select.json', json_encode($renderer->toArray($ast), 128));
//
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
//    $conditions = $builder->and(
//        $builder->eq(1, 2),
//        $recognized,
////        $builder->ge(2, 'count(Distinct U.id)'),
//        $builder->ne(3, 4),
////        $builder->in('U.id', [1, 2, 3, '(select id from users u limit 1)', 5, 6, 7, 'sum(U.id)'], true),
//        $builder->or(
////            '(u.id + 1 * 2) > sum(Distinct U.cnt)',
//            $builder->between('U.create', '2017', '2016'),
//            $builder->isNull('U.updated')
//        )
//    );

    echo "\n\n\n";
    
} catch (\Throwable $exception) {
    die(sprintf("\n-----------------\n[%s]: %s\n%s\n-----------------\n",
        get_class($exception), $exception->getMessage(), $exception->getTraceAsString()));
}