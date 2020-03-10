<?php

$jokes = $jokesTable->findAll();

$title = 'Joke list';

$templateVars = ['jokes' => $jokes];

$output = loadTemplate('../templates/list.html.php', ['jokes' => $jokes]);



//require  '../templates/layout.html.php';
