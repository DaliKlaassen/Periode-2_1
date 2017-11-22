<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>GastenBoek</title>
  </head>
  <body>
    <h1>Gastenboek</h1>
    <form method="POST" id="messageForm" target="">
      <label for="name">Naam</label>
      <input type="text" name="name" placeholder="Voor- en achternaam">
      <label for="message">Bericht</label>
      <textarea name="message" form="messageForm">Enter message here...</textarea>
      <input type="submit" name="submit" value="Versturen!">
    </form>
    <?php
      if(isset($_POST['submit'])){

        //CONNECTIE MAKEN MET DE DATABASE
          $servername = "localhost";
          $DBName = "22894_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBName", '22894_opdracht1', '22894_opdracht1');
    // ERROR LOGGING
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // PREPEARED STATEMNET ONTWERPEN
    $stmt = $conn->prepare("INSERT INTO gastenboek VALUES (:id, :name, :message)");

    // PARAMETERS BINDEN
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':message', $cleanedMessage);

    //WAARDEN IN EEN VARIABELE ZETTEN
    function badWordFilter($data){
        $originals = array("asshole","bitch","fuck");
        $replacements = array("!@#$%","!@#$%","!@#$%");
        $data = str_ireplace($originals,$replacements,$data);

        return $data;
    }
    $data = $_POST['message'];

    $cleaned = badWordFilter($data);

    $id = 0;
    $name = $_POST['name'];
    $cleanedMessage = $cleaned;

    // EXECUTE
    $stmt->execute();

    $to = 'dalimklaassen7@gmail.com';
    $subject = 'Nieuw bericht geupload!';
    $messageM = 'Er is een nieuw bericht geupload!';
    mail($to, $subject, $messageM);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
}
// ECHO DE VOORGAANDE BERICHTEN OP DE PAGINA
    $servername = "localhost";
    $DBName = "22894_database";

    $conn = new PDO("mysql:host=$servername;dbname=$DBName", '22894_opdracht1', '22894_opdracht1');
      $stmt = $conn->prepare("SELECT * FROM gastenboek");
      $stmt->execute() or die ('Error querying after PDO GETTING');
      while ($row = $stmt->fetch()){
        $name = $row['name'];
        $message = $row['message'];
        echo '<div class="post">';
        echo $name . '<br>';
        echo $message . '<br>';
        echo '</div>';
        $conn = null;
      }

     ?>
  </body>
</html>
