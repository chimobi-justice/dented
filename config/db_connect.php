<?php 

    define('ROOT_URL', 'http://localhost/dented/index.php');

    ##connect to database
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'dented');

    #### check connection
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die('unable to connect to database') . mysqli_connect_error($conn);
    }

?>