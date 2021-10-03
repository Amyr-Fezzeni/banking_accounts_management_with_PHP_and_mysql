<?php
include "db_conn.php";

session_start();

$msg="";


if (isset($_POST['submit_reclamation'])){

$id = $_SESSION['id'];
$sql1="select * from client where id='$id' ";
$result = $conn->query($sql1);
$res = $result->fetch_assoc();
$prenom=$res['prenom'];
$nom=$res['nom'];

$text_= $_POST['text'];
$date = date("Y-m-d H-i-s");

$text = str_replace("'","''",$text_);



$sql="insert into reclamation (id,prenom,nom,text,date) values ('$id','$prenom','$nom','".$text."','$date')";
if (mysqli_query($conn,$sql)){

$msg="Reclamation envoyé avec succée !";

}else {
    $msg="probleme d'envoi essayer une autre fois S.V.P !";
}






}

?>

<!DOCTYPE html>
<html> 

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href=".\css\form.css">

</head>

<body>

    <div class="navbar">

        <a href="index.php"><img src=".\img\log.png"></a>
        <a href="profil_.php"><img src=".\img\profile.png"></a>




       
        <a href="Accueil_.php">Accueil</a>



    </div>

    <div class="sidebar"><br><br><br>
        <a href="operation_.php">Suivie les Operations</a>
        <br>
        <a href="transfert_argent_.php">Transferer d'argent</a>
        <br>
        <a href="demande_carnet_cheque_.php">Demander un carnet de chéque</a>
        <br>
        
        <a href="reclamation_.php">Ajouter une reclamation</a>
        <br>
        

    </div>
    <div class="content">




<h1 style="text-align: center">Ajouter une reclamation </h1>

<form class="form-style-1" name="profileform" method="POST" action="reclamation_.php">

       
        <table border="0" class="s" >


            <tr>
                <td style="text-align: left; width:80px;">

                    <textarea name="text" value="" rows="7" cols="120"></textarea>
                </td>





            </tr>
            <tr>
                
                <td style="text-align: right;"><input type="submit" name="submit_reclamation" value="Envoyer" ></td>
            </tr>




        </table>

</form>


        <br><br>
<h1 style="text-align: center"><?php echo $msg; ?></h1>

<br><br>

</body>

</html>