<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gastenboek</title>
</head>
<body>
<h1>Cem den Ouden</h1>
<h2>MD2A</h2>
<div class="containerComments">
    <form id="contactComments" action="" method="post">
        <h1>Berichten van andere!</h1><br/>


        <?php

        $dbc = new PDO('mysql:host=localhost;dbname=22315_bewijzenmap', '22315_root', 'root123');

        $stmt = $dbc->prepare("SELECT * FROM gastenboek_comments ORDER BY id DESC)");
            $stmt->execute() or die('Fatal error querying after PDO COMMENTS');
            while ($row = $stmt->fetch()){
                $username = $row['username'];
                $date = $row['date'];
                $comment = $row['user_message'];
                echo "<fieldset>";
                echo "<h2>" . $username . " left a message on ". $date ." <br/></h2>";
                echo "<h4><i>" . $comment . "</i></h4>";
                echo "</fieldset>";

            }
            ?>

        <h4>Ga <a href="../index.php">hier</a> naar de homepagina!</h4>
    </form>
</div>

</body>
</html>

