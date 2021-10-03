<?php
include "db_conn.php";

session_start();

$msg="";


if (isset($_POST['demander'])){

$id = $_SESSION['id'];
$sql1="select * from client where id='$id' ";
$result = $conn->query($sql1);
$res = $result->fetch_assoc();

$prenom=$res['prenom'];
$nom=$res['nom'];

$date = date("Y-m-d H-i-s");





$sql="INSERT INTO cheque(etat,id,numcp,prenom,nom,date) VALUES ('En attente','$id','".$_SESSION['numcp']."','$prenom','$nom','$date')";

if (mysqli_query($conn,$sql)){

$msg="Demande envoyé avec succée !";

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




<fieldset><legend><h1 style="text-align: center">Demande carnet des chéques</h1></legend>

<form class="form-style-1" name="profileform" method="POST" action="demande_carnet_cheque_.php">

       
        <table border="0" class="s" >


           
            <tr>
                <td>Pour demander un carnet des chéques cliquez sur demander</td>
                
                <td style="text-align: center;"><input type="submit" name="demander" value="Demander" ></td>
            </tr>




        </table>

</form>

</fieldset>
        <br><br>
<h1 style="text-align: center"><?php echo $msg; ?></h1>

<br><br>

</body>

</html>