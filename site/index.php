<html lang="en"> 
<head>
  
    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>
</head>

<body>
    <p>&nbsp;</p>
    <div class="container">
    <table class="table table-hover"> 
            <tr>
                <th>Student Name</th>
                <th>GPA</th>
                <th>Classes</th>
                <tr>
            </tr>
            <tbody>
            <?php
            $json = file_get_contents ('data/student_info.txt');
                $iter = new RecursiveIteratorIterator( new RecursiveArrayIterator(json_decode($json, true)), RecursiveIteratorIterator::SELF_FIRST);
                $studentNames = 'Student Name';
                $gpas = 'GPA';
                
                foreach($iter as $key=>$value)
                {
                    if($studentNames==$key && $value!=='')
                    {
                        $nameresults[] = $value;
                    }
                    else if($gpas==$key && $value!=='')
                    {
                        $gparesults[] = $value;
                    }
                }

                echo "$nameresults[0]";
                echo "$gparesults[0]";
                ?>
            </tbody>
        </table>

    </div>
<!-- Latest compiled and minified JavaScript -->
<script src="public/js/jquery-3.3.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
</body>

</html>