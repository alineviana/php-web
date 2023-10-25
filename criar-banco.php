<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO(dsn: "sqlite:$dbPath");
$pdo->exec(statement:'CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT);');