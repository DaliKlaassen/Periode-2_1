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
        $dbc = mysqli_connect('localhost', '22894_opdracht1', '22894_opdracht1', '22894_database') or die ('Error connect');

        $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        $message = mysqli_real_escape_string($dbc, trim($_POST['message']));

        $bad_words = array("bitch", "asshole", "dumb", "fuck", "stupid", "nigger", "pussy", "dick", "prostitute", "cum");

      if (!empty($name) && !empty($message)) {
        $word_array = preg_split('/\s|(?<=\w)(?=[.,:;!?)])|(?<=[.,"!()?\x{201C}])/u', $message);
          foreach($word_array as $word){
              if(in_array(strtolower($word), $bad_words)){
                  $message = preg_replace('/\b'.$word.'\b/i', "!@#$%", $message);
              }
          }
        }
          $query = "INSERT INTO gastenboek VALUES (0,'$name','$message')";
          $result = mysqli_query($dbc, $query) or die ('Error querying');
          $to = 'dalimklaassen7@gmail.com';
          $subject = 'Nieuw bericht geupload!';
          $messageM = 'Er is een nieuw bericht geupload!';
            mail($to, $subject, $messageM);
              mysqli_close($dbc);
          }

      $dbc = mysqli_connect('localhost','22894_opdracht1','22894_opdracht1','22894_database') or die ('Error connecting!');
      $query = "SELECT * FROM  gastenboek";
      $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result)){
            $name = $row['name'];
            $message = $row['message'];
            echo '<div class="post">';
            echo $name . '<br>';
            echo $message . '<br>';
            echo '</div>';
        }
        mysqli_close($dbc);
     ?>
  </body>
</html>
