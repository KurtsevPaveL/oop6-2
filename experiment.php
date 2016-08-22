<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'dbpass.php';

$experimentId = filter_input(INPUT_GET, 'experimentId');
echo "Experiment #$experimentId";

try {
    $dbh = new PDO("mysql:host=localhost; dbname=$db", $user, $pass);
    $dbh->exec("set names utf8");
    $sql = "SELECT num, countn FROM results INNER JOIN experiment ON results.id_exp=experiment.id_exp WHERE results.id_exp = :id_exp;";
    $query = $dbh->prepare($sql);
    $query->execute(array(':id_exp' => $experimentId));
    $dbh = NULL;
} catch (PDOException $e) {
    echo $e->getMessage();
}

while ($oneRow = $query->fetch()) {
    $num = $oneRow["num"];
    $quantityOfNum = $oneRow["countn"];
    echo "<div>Sum bones $num amounted $quantityOfNum times</div>";
}
