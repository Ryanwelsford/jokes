<?php 
$title = 'Delete a Joke';
if (isset($_POST['submit'])){
    //$value = ['id' => $_POST['id']];
    $jokesTable->delete('id',$_POST['id']);
    //header('location: /jokes');
}
else {
    $templateVar = ['id' => $_GET['id']];
    $output = loadTemplate('../templates/delete.html.php', $templateVar);
}