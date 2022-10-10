<?php
try {

    $dbh = new PDO('mysql:host=localhost;dbname=ROOP', 'root', '');
    echo 'coonected ya m3alem';

} catch (Exception $e) {
    echo 'failed to connect to database';
}
?>