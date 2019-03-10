# sql
## SQL Parser-QueryBuilder

### Main Factory

```php
$factory = Sql::getInstance();
```

### Query/Builder

```php
$query = $factory->newQuery();
$builder = $query->getBuilder();
```

### Create AST

```php
$parser = $factory->getProcessor(); // as default
$parser->getLexer()->tokenize('select U.id, U.name, max(U.id) from users U where U.id > 100');
$ast = $parser->parse();
```

### Converter

```php
$converter = $factory->getConverter();

$array  = $converter->toArray($ast); 
$ast    = $converter->toNode($array); 

$converter->toSql($ast); 
// > SELECT U.id, U.name, MAX(U.id) FROM users AS U WHERE U.id > 100
```

### Query/Builder

#### Select
```php
$query->reset(); // optional. this action rewrite root node

$query->select('users')->noCache();
$query->columns('test', 'id', 'created', 'count(*) cnt');
$query->where('id = 1'); 

$query->getSql();
```
```$sql
SELECT SQL_NO_CACHE (test, id, created, COUNT(*) AS cnt) FROM users WHERE id = 1
```

#### Insert
```php
$query->reset(); // optional. this action rewrite root node

$query->insert('users U')->ignore();
$query->fields('U.name', 'created');
$query->values([
    ['tedd', '2019-01-01'],
]);
$query->values([
    ['john', $builder->sql('now()')],
    ['nedd', '2019-01-01'],
]);

$query->getSql();
```
```$sql
INSERT IGNORE INTO users AS U (U.`name`, created) VALUES ('tedd', '2019-01-01'), ('john', NOW()), ('nedd', '2019-01-01') 
```

#### Update
```php
$query->reset(); // optional. this action rewrite root node

$query->update('users U')->delayed();
$query->sets([
    'name' => 'John',
    'date' => '2018-01-01',
    'hits' => $builder->sql('sum(U.hit)')
]);

$where = $builder->and(
    $builder->or('U.id > 2', 'U.id < len(U.email)'),
    $builder->or('U.id < 0', 'U.id > len(U.name)', $builder->eq('x', $builder->sql('len(x)')))
);

$query->where($where);
```
```$sql
UPDATE DELAYED users AS U SET name = 'John', date = '2018-01-01', hits = SUM(U.hit) WHERE (U.id > 2 OR U.id < LEN(U.email)) AND (U.id < 0 OR U.id > LEN(U.name) OR x = LEN(x))
```

#### Delete
```php
$query->reset(); // optional. this action rewrite root node

$query->delete('users U')->quick();
$query->where(
    $builder->or(
        'U.id = 1', 
        $builder->ge('U.id', 1000), 
        $builder->ge('U.access', 
            $builder->sql('rand()')
        ))
);
$query->limit(1);

$query->getSql();
```
```$sql
DELETE QUICK users AS U WHERE (U.id = 1 OR U.`id` >= 1000 OR U.`access` >= RAND()) LIMIT 0, 1
```