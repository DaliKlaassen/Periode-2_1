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
        $dbc = new PDO('mysql:host=localhost;dbname=22894_database', '22894_opdracht1', '22894_opdracht1');


        $message = $_POST['message'];

        function badWordFilter($data){
          $originals = array("asshole","bitch","fuck");
          $replacements = array("!@#$%","!@#$%","!@#$%");
          $data = str_ireplace($originals,$replacements,$data);

          return $data;
        }
          $myData = $message;

          //PREPARED STATEMENT ONTWERPEN
          $stmt = $dbc->prepare("INSERT INTO gastenboek VALUES (?,?,?");

          //PARAMETERS BINDEN
          $stmt->bindParam(1,$userid);
          $stmt->bindParam(2,$name);
          $stmt->bindParam(3,$cleaned);

          //WAARDEN IN VARIABELEN ZETTEN
          $userid = 0;
          $name = $_POST['name'];
          $cleaned = badWordFilter($myData);

          //EXECUTE
          $stmt->execute() or die ('Error querying after PDO');

}


          // $to = 'dalimklaassen7@gmail.com';
          // $subject = 'Nieuw bericht geupload!';
          // $messageM = 'Er is een nieuw bericht geupload!';
          //   mail($to, $subject, $messageM);
              // mysqli_close($dbc);
      // }


//      $dbc = new PDO('mysql:host=localhost;dbname=22894_database', '22894_opdracht1', '22894_opdracht1');
//      $stmt = $dbc->prepare("SELECT * FROM gastenboek");
//      $stmt->execute() or die ('Error querying after PDO GETTING');
//      while ($row = $stmt->fetch()){
//        $name = $row['name'];
//        $message = $row['message'];
//        echo '<div class="post">';
//        echo $name . '<br>';
//        echo $message . '<br>';
//        echo '</div>';
//      }
      // $query = "SELECT * FROM  gastenboek";
      // $result = mysqli_query($dbc, $query);
      //   while ($row = mysqli_fetch_array($result)){
      //       $name = $row['name'];
      //       $message = $row['message'];
      //       echo '<div class="post">';
      //       echo $name . '<br>';
      //       echo $message . '<br>';
      //       echo '</div>';
      //   }
      //   mysqli_close($dbc);
     ?>
  </body>
</html>
