<?php
    
    $title = 'Internet Joke Database';
    $results = $jokesTable->find('id', 1);
    $joke = $results[0];
    $templateVar = ['joke' => $joke['joketext']];
    $output = loadTemplate('../templates/home.html.php', $templateVar);

?>