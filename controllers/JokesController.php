<?php

class JokeController {
    private $jokesTable;

    public function __construct($jokesTable) {
        $this->jokesTable = $jokesTable;
    }

    public function home() {
    $title = 'Internet Joke Database';
    $results = $this->jokesTable->find('id', 1);
    $joke = $results[0];
    $output = loadTemplate('../templates/home.html.php', ['joke' => $joke['joketext']]);
    return ['template' => 'home.html.php',
            'title' => 'Internet Joke Database',
            'variables' => [
                'joke' => $joke['joketext']]
    ];
    }

    public function jokes() {
    $jokes = $this->jokesTable->findAll();

    $title = 'Joke list';

    $templateVars = ['jokes' => $jokes];

    //$output = loadTemplate('../templates/list.html.php', ['jokes' => $jokes]);
    return ['template' => 'list.html.php',
            'title' => 'Joke list',
            'variables' => [
                'jokes' => $jokes
            ]];
    }

    public function deletejoke() {
        $title = 'Delete a Joke';
        if (isset($_POST['submit'])){
            //$value = ['id' => $_POST['id']];
            $this->jokesTable->delete('id',$_POST['id']);
            header('location: /joke/list');
        }
        else {
            $templateVar = ['id' => $_GET['id']];
            $output = loadTemplate('../templates/delete.html.php', $templateVar);
            return ['template' => 'delete.html.php',
                    'title' => $title,
                    'variables' => [
                        'id' => $_GET['id']
                    ]];
        }
    }

    public function editjoke() {
        if (isset($_GET['id'])) {
            $results = $this->jokesTable->find('id', $_GET['id']);
            $record = $results[0];
        }
        else {
            $record = false;
            $date = new DateTime();
            $_POST['joke']['jokedate'] = $date->format('Y-m-d H:i:s');
        }
        
        if (isset($_POST['joke']['joketext'])) {
            $this->jokesTable->save($_POST['joke']);
            header('location: /joke/list');
        }
        else {
            //$output = loadTemplate('../templates/editjoke.html.php', ['joke' => $record]);
            $title = 'Edit joke';
            return ['title' => $title,
                    'template' => 'editjoke.html.php',
                    'variables' => [
                        'joke' => $record
                    ]];
        }
    }
}