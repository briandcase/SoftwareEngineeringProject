<?php
    // get the index
    $index = $_GET['index'];

    // fetch data from json
    $data = file_get_contents('members.json');
    $data = json_decode($data);

    // delete the row with the index
    array_splice($data, $index, 1);

    // encode back to json
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('members.json', $data);

    header('location: index.php');
 ?>
