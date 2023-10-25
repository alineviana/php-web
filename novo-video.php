<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO(dsn: "sqlite:$dbPath");

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

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $_POST['url']);
$statement->bindValue(2, $_POST['titulo']);

if ($statement->execute() === false) {
    header(header: 'Location: /index.php?sucesso=0');
} else {
    header(header: 'Location: /index.php?sucesso=1');
}
