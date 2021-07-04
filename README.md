# Yamitec ORM
É um modulo de conexao com banco de dados que permite efetuar queries SQL de maneira programatica e facilitada

## Instalacao

``` composer require yamitec/yamitec-orm ```

### USO

```
<?php
$db = new \YamiTec\ORM\YamiORM(new \YamiTec\ORM\Adapters\MySQLAdapter());

// para trazer todos os registros da tabela "Users" cujo valor do campo "name" é igual a "teste" ordenados por "id" e agrupados por "email"
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->order("id")->group("email")->getAll();
print_r($result);


// para trazer apenas um objeto da tabela "Users" cujo valor do campo "name" é igual a "teste"
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->get();
print_r($result);

// para trazer 10 registros da tabela "Users" cujo valor do campo "name" é igual a "teste"
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->limit(10)->getAll();
print_r($result);

// para trazer todos os registros da tabela "Users" cujo valor do campo "name" é igual a "teste" e "admin"
$result = $db->Select()->from("Users")->Where(["name" => "teste", "name" => "admin"])->getAll();
// ou adicione mais um metodo where em cadeia
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->Where(["name" => "admin"])>getAll();
print_r($result);

// para trazer todos os registros da tabela "Users" cujo valor do campo "name" é igual a "teste" ou "admin"
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->OrWhere(["name" => "admin"])>getAll();
print_r($result);

// para imprimir a query
$result = $db->Select()->from("Users")->Where(["name" => "teste"])->OrWhere(["name" => "admin"])>toString();
print_r($result);
```

## Insert
``` 
<?php
$db = new \YamiTec\ORM\YamiORM(new \YamiTec\ORM\Adapters\MySQLAdapter());
$data = ["name" => "Aurelio", "email" => "aurelio@pt.br"];
$db->Create("Users", $data);

// efetua o cadastro do registro de nome Aurelio na tabela Users
 ```

 ## Update
``` 
<?php
$db = new \YamiTec\ORM\YamiORM(new \YamiTec\ORM\Adapters\MySQLAdapter());
$data = ["name" => "Aurelio Nunes", "email" => "aurelio@pt.br"];
$db-->Update("Users", $data)->Where(["id" => 1])->execute();

// Aplica as Alteracoes ao registro de id = 1 na tabela Users
 ```

