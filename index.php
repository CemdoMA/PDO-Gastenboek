<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
		<title>Gastenboek</title>
	</head>
	<body>
    <h1>Cem den Ouden</h1>
    <h2>MD2A</h2>
		<div class="container">
		  <form id="contact" action="" method="post">
		    <h3>Laat een leuk berichtje achter</h3>
		    <fieldset>
		      <input placeholder="U naam" type="text" tabindex="1" required autofocus name="user_name">
		    </fieldset>
		    <fieldset>
		      <textarea placeholder="Typ hier uw bericht" tabindex="5" required name="user_message"></textarea>
		    </fieldset>
		    <fieldset>
		      <button name="submit" type="submit" id="contact-submit" data-submit="...Verzenden">Verzenden</button>
		    </fieldset>
<!--              <div class="links">-->
              <strong><h4>Ga <a href="view/comments.php">hier</a> naar de comments!</h4></strong>
              <button onclick="alert('asshole,bitch,fuck,motherfucker,redneck,shit,piece of shit,shithead,cunt,suck,Jew,Nazi,Hitler,loser,cancer')">Lijst van verboden woorden</button>
<!--              </div>-->
		  </form>
		</div>

	</body>
</html>

<?php
$dbc = new PDO('mysql:host=localhost;dbname=22315_bewijzenmap', '22315_root', 'root123');

if(isset($_POST['submit'])){

    if (preg_match("%[a-zA-Z]%", $_POST["user_name"])) {
        $message_user = strip_tags($_POST['user_message']);

        function noBadWordsAllowed($data){
            $badwords = array("asshole","bitch","fuck","motherfucker","redneck","shit","piece of shit","shithead","cunt","suck","Jew","Nazi","Hitler","loser","cancer");
            $replacement_words = array("Bobba","Bobba","Bobba","Bobba","Bobba","Bobba","Bobba","Bobba","Bobba","Bobba");
            $data = str_ireplace($badwords,$replacement_words,$data);

            return $data;
        }
        $cleaned = noBadWordsAllowed($message_user);

        $username = strip_tags($_POST['user_name']);
        $date = date("d-m-Y/H:m:s");


        $stmt = $dbc->prepare("INSERT INTO gastenboek_comments VALUES (0, :username, :date, :cleaned)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':cleaned', $cleaned);
        $stmt->execute() or die('Fatal error querying after PDO INDEX');

        $message = 'You have recived a new message'; //' . $username . "<br/></br/>" . $cleaned . "<br/></br> Date: " . $date
        $to = '22315@ma-web.nl';
        $subject = 'New message';
        $from = 'Gastenboek INC.';
        mail($to, $subject, $message, 'From:' . $from);

        header('location:view/comments.php');
    }else{
        echo "INVALID NAME";
    }

}
?>

