<html>

<head>
    <title>Query Results</title>
</head>

<body>

<div align="left">
<?php

if (array_key_exists('id', $_POST)) {

    $stud_id = $_POST['id'];
    echo '<b>ID:</b> ', $stud_id, '<br><br>';

    $stud_json = json_decode(file_get_contents('data/student_info.txt'), true);

    if (array_key_exists($stud_id, $stud_json)) {

        $stud_info = $stud_json[$stud_id];

        foreach($stud_info as $key => $value){

            echo '<b>', $key, '</b>: ';

            if ($key == 'Classes') {

                echo '<br><ul>';
                foreach($value as $class) {
                    foreach($class as $class_name => $test_scores) {
                        echo '<li><b>', $class_name, '</b></li><ul>';
                        foreach($test_scores as $test => $score) {
                            echo '<li>', $test, ': ', $score, '</li>';
                        }
                        echo '</ul><br>';
                    }
                }
                echo '</ul>';
            } else {
                echo $value, '<br><br>';
            }
        }
    } else {
        echo 'ID does not exist, go back to the previous page.';
    }
} else {
    echo 'No Student ID, go back to the previous page. <br>';
}

?>
</div>

</body>

</html>
