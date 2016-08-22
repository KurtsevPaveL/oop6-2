<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>115-kurtsev-oop6-2</title>
        <script src="js/jquery.min.js"></script>
        <script src="js/js.js"></script>
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        require_once 'dbpass.php';
        try {
            $dbh = new PDO("mysql:host=localhost; dbname=$db", $user, $pass);
            $dbh->exec("set names utf8");
            $sql = "SELECT id_exp, date, time FROM experiment;";
            $q = $dbh->prepare($sql);
            $q->execute();
            $dbh = NULL;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        <div>
            <?php
            while ($row = $q->fetch()) {
                $rowId = $row['id_exp'];
                $rowDateTime = $row['date'] . " " . $row['time'];
                echo "<a href='experiment.php?experimentId=$rowId'>Experiment #$rowId Date: $rowDateTime </a> <br>";
            }
            ?>
        </div>
    </body>
</html>
