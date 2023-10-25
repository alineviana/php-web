<?php

use function PHPSTORM_META\type;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO(dsn: "sqlite:$dbPath");

$id = filter_input(type: INPUT_GET, var_name: 'id', filter: FILTER_VALIDATE_INT);
if ($id == false) {
    header(header: 'Location: /index.php?sucesso=0');
    exit();
}

$url = filter_input(type: INPUT_POST, var_name: 'url', filter: FILTER_VALIDATE_URL);

if ($url === false) {
    header(header: 'Location: /index.php?sucesso=0');
    exit();
}

$titulo = filter_input(type: INPUT_POST, var_name: 'titulo');

if($titulo === false) {
    header(header: 'Location: /index.php?sucesso=0');
    exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id), type();

if ($statement->execute() === false) {
    header(header: 'Location: /index.php?sucesso=0');
} else {
    header(header: 'Location: /index.php?sucesso=1');
}
