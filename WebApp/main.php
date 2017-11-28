<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WebApp</title>
  </head>
  <body>
    <?php

    $id = 0;
    $frstn = $_POST["firstName"];
    $prepos = $_POST["preposition"];
    $surn = $_POST["surName"];
    $tpSel = $_POST["typeSelect"];
    $valOutp = $_POST["valueOutput"];
    $valOutpEx = $_POST["valueOutputExtra"];
    echo $tpSel;
    echo $valOutp;
    echo $valOutpEx;
// Bind server credentials
    $srvn = "localhost";
    $usrn = "root";
    $pssw = "root";
    $dbn = "webapp";

// Check connection
try {
    $dbc = new PDO("mysql:host=$srvn;dbname=$dbn", $usrn, $pssw);
    // Set the PDO error mode to exception
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbc->prepare("INSERT INTO webapp_data VALUES (:id, :frstn, :prepos, :surn, :tpSel, :valOutp, :valOutpEx)");

    $query->bindParam(':id', $id);
    $query->bindParam(':frstn', $frstn);
    $query->bindParam(':prepos', $prepos);
    $query->bindParam(':surn', $surn);
    $query->bindParam(':tpSel', $tpSel);
    $query->bindParam(':valOutp', $valOutp);
    $query->bindParam(':valOutpEx', $valOutpEx);

    $dbc->execute($query);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    $dbc = null;
    ?>
  </body>
</html>
