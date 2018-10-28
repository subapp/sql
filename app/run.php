<?php

use Subapp\Sql\Lexer\Lexer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = '0000';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new Lexer();

$lexer->setInput($sql);

echo PHP_EOL;

//die(var_dump($lexer));

echo "====== SQL ======\n";
echo $sql;

echo "\n====== Tokens ======\n";

/** @var \Subapp\Lexer\TokenInterface $token */
foreach ($lexer as $token) {
    echo sprintf('%s ', $lexer->getConstantName($token->getType())) . PHP_EOL;
}

$lexer->rewind();

$processor = new \Subapp\Sql\Parser\Processor($lexer, new Subapp\Sql\Platform\MySQLPlatform());

$processor->addParser(new \Subapp\Sql\Parser\Statement\SelectParser());
$processor->addParser(new \Subapp\Sql\Parser\Common\FromParser());
$processor->addParser(new \Subapp\Sql\Parser\Func\TrimParser());

var_dump($processor->parse());