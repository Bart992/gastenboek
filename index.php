<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Gastenboek</title>
  </head>
  <body>
    <form method="POST" action="#">

      <input type="text" name="name" placeholder="Naam">
      <input type="text" name="topic" placeholder="Onderwerp">
      <textarea type="text" name="review" placeholder="tekst"></textarea>
      <input type="submit" name="submit">

    </form>



    <?php

      $woorden = array('reinier','rowin','nick');

      $dbc = mysqli_connect('localhost','root','root','gastenboek') or die ("Error connecting");


      if(isset($_POST['submit'])) {

      $name = mysqli_real_escape_string($dbc,trim($_POST['name']));
      $topic = mysqli_real_escape_string($dbc,trim($_POST['topic']));
      $review = mysqli_real_escape_string($dbc,trim($_POST['review']));



      foreach ($woorden as $nowoorden){
      if (preg_match("/\b$nowoorden\b/",$name)){
        die("Ga weg");
      }else {
        $query = "INSERT INTO gastenboek VALUES (0, '$name', '$topic', '$review')";
        $result = mysqli_query($dbc, $query) or die ("error");
        break;
      }
    }



      $to = '22683@ma-web.nl';
      $subject = 'Nieuw bericht ';
      $msg = '<b>Er is een bericht geplaats door: </b>' . $name
      . '<p><b>Onderwerp:</b></p>' . $topic . '<br>
      <p><b>Bericht:</b></p>' . $review . '<br>';

      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: review@ma-web.nl' . "\r\n";
      $headers .= '' . "\r\n";

      mail($to,$subject,$msg,$headers);

}

      $query = "SELECT * FROM gastenboek ORDER BY id DESC";
      $result = mysqli_query($dbc, $query) or die ("error 2");
      while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $topic = $row['topic'];
        $review = $row['review'];

      echo '<br> Naam: ' . $name . '<br> Onderwerp: ' . $topic . '<br> Bericht ' . $review . '<p>';


}



    ?>




  </body>
</html>
