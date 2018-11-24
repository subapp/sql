# sql
## SQL Parser-QueryBuilder

### Configuration

```php
$sql = new Sql\Sql();

// example
$sql->setCache(new Application\PsrCachePoolImpl());
```

### Create AST

```php
$sql = new Sql\Sql();

$ast = $sql->createAstFromString('select U.id, U.name, max(U.id) from users U where U.id > 100');
```

### Converter

```php
$converter = $sql->getConverter();

$array = $converter->toArray($ast); 
$ast = $converter->toNode($array); 

$converter->toSql($ast); 
// > SELECT U.id, U.name, MAX(U.id) FROM users AS U WHERE U.id > 100
```

### Query Builder

```php
$sql = new Sql\Sql();
$qb = new Query\QueryBuilder();
$ast = $sql->createAstFromString('select U.id, U.name, max(U.id) from users U where U.id > 100');
$node = $qb->node();

$qb->setRoot($ast->getRoot());

$qb
    ->group('U.id')
    ->order('U.name asc, rand()', 'U.id desc');

$c->add($node->ne('U.id', 1000));

$converter->toSql($ast); 
// SELECT U.id, U.name, MAX(U.id) 
// FROM users AS U WHERE U.id > 100
// WHERE U.id <> 1000
// GROUP BY U.id
// ORDER BY U.name ASC, RAND(), U.id DESC
```