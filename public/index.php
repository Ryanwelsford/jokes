<?php

require '../functions/loadTemplate.php';
require '../dbconnect.php';
require '../classes/DatabaseTable.php';
require '../controllers/JokesController.php';

$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
$jokeController = new JokeController($jokesTable);
/* $_SERVER['REQUEST_URI'];
echo $_SERVER['REQUEST_URI']; */
$route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
if ($route == '') {
    $page = $jokeController->home();
}
else if ($route == 'home') {
    $page = $jokeController->home();
}
else if ($route == 'joke/list') {
    $page = $jokeController->jokes();
}
else if ($route == 'joke/edit') {
    $page = $jokeController->editjoke();
}
else if ($route == 'joke/delete') {
    $page = $jokeController->deletejoke();
}
else {
    $page = $jokeController->home();
}
//echo $route;
/*if ($_SERVER['REQUEST_URI'] !== '/') {
    $functionName = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
    $page = $jokeController->$functionName();
   }
   else {
    $page = $jokeController->home();
    var_dump($page);
    echo $page;
   }*/
$output = loadTemplate('../templates/' . $page['template'], $page['variables']);
$title = $page['title'];
   
/*if(isset($_GET['page'])) {
    require '../pages/' . ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/') . '.php';
}
else {
    require '../pages/home.php';
}*/


require  '../templates/layout.html.php';