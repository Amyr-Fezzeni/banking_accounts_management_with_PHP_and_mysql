<?php
include "db_conn.php";

session_start();
$id="";
$name="";
$numcp="";
$name_cp="";
$id_empl="";
$name_empl="";

$msg_client="";
$msg_cp="";
$msg_empl="";

$compte_actif="false";
                        
if(isset($_POST['chercher_client']))
{
  $id=$_POST['id'];
  $sql ="SELECT prenom,nom from client where id='$id' ";
  $query_run=$conn->query($sql);
  $r=$query_run->fetch_assoc();
  $name = $r['prenom']." ".$r['nom'];   

  $numcp="";
  $name_cp="";
  $id_empl="";
  $name_empl="";
}
if (isset($_POST['confirmer_client'])){

    $id=$_POST['id'];
    $sql ="delete from compte where id='$id' ";
    $sql2="delete from connexion where id ='$id'";
    $sql3="delete from client where id ='$id'";

    if(mysqli_query($conn,$sql)&&mysqli_query($conn,$sql2)&&mysqli_query($conn,$sql3)){

    $msg_client="Client supprimé avec succés.";
}else {
    $msg_client="probleme de suppression essayer une autre fois S.V.P !";
}
}


if(isset($_POST['chercher_compte']))
{
  $numcp=$_POST['numcp'];
  $sql ="SELECT prenom,nom from compte where numcp=$numcp ";
  $query_run=$conn->query($sql);
  $r=$query_run->fetch_assoc();
  $name_cp = $r['prenom']." ".$r['nom'];

    $id="";
    $name="";
    $id_empl="";
    $name_empl=""; 
}
if (isset($_POST['confirmer_compte'])){

    $numcp=$_POST['numcp'];
    $sql ="delete from compte where numcp=$numcp ";
    if(mysqli_query($conn,$sql)){

    $msg_cp="Compte supprimé avec succés.";
}else {
    $msg_cp="probleme de suppression essayer une autre fois S.V.P !";
}
}


if(isset($_POST['chercher_empl']))
{
  $id_empl =$_POST['id_empl'];
  $sql ="SELECT prenom,nom from employes where id='$id_empl' ";
  $query_run=$conn->query($sql);
  $r=$query_run->fetch_assoc();
  $name_empl = $r['prenom']." ".$r['nom'];

    $id="";
    $name="";
    $numcp="";
    $name_cp="";
}
if (isset($_POST['confirmer_empl'])){

    $id_empl=$_POST['id_empl'];
    $sql2="delete from connexion where id ='$id_empl'";
    $sql3="delete from employes where id ='$id_empl'";
    
    if(mysqli_query($conn,$sql2)&&mysqli_query($conn,$sql3)){

    $msg_empl="emplyé supprimé avec succés.";
}else {
    $msg_empl="probleme de suppression essayer une autre fois S.V.P !";
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
    <script type="text/javascript">

        function verif_client(){

            if (document.getElementById('id').value != ""){
                document.getElementById('confirmer_client').disabled=false;
            }
            else{
                 document.getElementById('confirmer_client').disabled=true;
            }

        }
        function verif_compte(){

              if (document.getElementById('numcp').value != ""){
                document.getElementById('confirmer_compte').disabled=false;
            }
            else{
                 document.getElementById('confirmer_compte').disabled=true;
            }
        }
        function verif_employe(){
              if (document.getElementById('id_empl').value != ""){
                document.getElementById('confirmer_empl').disabled=false;
            }
            else{
                 document.getElementById('confirmer_empl').disabled=true;
            }

        }
      
    </script>

    <div class="navbar">

        <a href="index.php"><img src=".\img\log.png"></a>
        <a href="profil.php"><img src=".\img\profile.png"></a>




        <div class="dropdown">
            <button class="dropbtn">Ajouter<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="ajout_client.php">Client</a>
                <a href="ajout_compte.php">Compte</a>
                <a href="ajout_employe.php">Employer</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Modifier<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="modifier_client.php">Client</a>
                <a href="modifier_employe.php">Employer</a>
            </div>
        </div>
        <a href="supression.php">Suprimer</a>
        <a href="Accueil.php">Accueil</a>



    </div>

    <div class="sidebar"><br><br><br>
        <a href="gestion_des_clients.php">Gestion des clients</a>
        <br>
        <a href="gestion_des_comptes.php">Gestion des comptes</a>
        <br>
        <a href="gestion_des_operations.php">Gestion d'operation</a>
        <br>
        <a href="gestion_des_employes.php">Gestion d'employes</a>
        <br>
        <a href="gestion_des_reclamations.php">Gestion des reclamations</a>
        <br>
        <a href="gestion_des_cheques.php">Gestion des chéques</a>
        <br>
        <a href="transactions.php">Transactions</a>

    </div>
    <div class="content">
        <fieldset align=center>
            <legend>supprimer un client</legend>
            <br><br>
            <form class="form-style-1" name="suppclient" method="POST" action="supression.php" >
                <table align="left" border="0">

                    <tr>
                        <td colspan=2 align="left">
                            <input type="text" id="id" name="id" placeholder="ID Client" value="<?php echo $id;?>">
                        </td>
                        <td style="text-align: left;">
                            <input type="submit" value="chercher" id="chercher" name="chercher_client" style="min-width: 185px"> </td>

                        <td style="min-width:195px"> </td>

                        
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align: left;">
                           Nom du client :
                        </td>
                        <td align="left"> <br>


                            <input type="Text" name="client_name" id="client_name"  value="<?php echo $name;?>">

                           
                        </td>
                        <td></td>
                       
                    </tr>
                    <tr>
                    <td colspan=2></td>
                    <td style="text-align: left;"><input type="submit" id="confirmer_client" name="confirmer_client" style="min-width: 185px" value="confirmer" ></td>
                    </tr>

                </table>
                </form>
           
            
               <center> <h3 style="text-align: center; text-transform: lowercase;"><br><br><br><br><br> <?php echo $msg_client; ?></h3></center>
 
        </fieldset>
        <br>

        <fieldset align=center>
            <legend>Supprimer un compte</legend>

            <form class="form-style-1" name="suppcompte" method="POST" action="supression.php" >

                <table align="left" border=0>
                    
                    <tr>
                        <td style="text-align: left; ">
                            <input type="text" id="numcp" name="numcp" placeholder="n° Compte" value="<?php echo $numcp; ?>">
                        </td>

                        <td  style="text-align: left;">

                            <input type="submit" name="chercher_compte" value="Chercher" style="min-width: 185px" ></td>
                        <td style="min-width:195px"></td>
                    </tr>
                    <tr>
                        <td  style="text-align:left;" >
                            Propriétaire du compte :
                        </td>
                   

                        <td style=" text-align: left;" ><br>
                            <input type="Text" name="client_name" id="client_name" value="<?php echo $name_cp;?>">
                            
                        </td>

                    
                    </tr>
                    
                    <tr>
                        <td ></td>
                        <td  style=" text-align: left;"><input type="submit" name="confirmer_compte" style="min-width: 185px" value="confirmer"></td>
                       </tr>

                </table>
            </form>
            <center> <h3 style="text-align: center; text-transform: lowercase;"><br><br><br><br><br> <?php echo $msg_cp; ?></h3></center>
        </fieldset>
        <br><br>
        <fieldset align=center>
            <legend>supprimer un employé</legend>
            <br><br>
            <form class="form-style-1" name="suppempl" method="POST" action="supression.php">
                <table align="left" border="0">

                    <tr>
                        <td colspan=2 align="left">
                        <input type="text" id="id_empl" name="id_empl" placeholder="ID Employé" value="<?php echo $id_empl;?>"></td>
                        <td style="text-align: left;">
                            <input type="submit" value="chercher" id="chercher_empl" name="chercher_empl" style="min-width: 185px"> </td>
                        <td style="min-width:195px"> </td>

                        
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align: left;">
                           Nom du l'employé :
                        </td>
                        <td align="left"> <br>

               

                            <input type="Text" name="name_empl" id="name_empl"  value="<?php echo $name_empl; ?>">


                           
                        </td>
                        <td></td>
                       
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align: left;">
                            
                        </td>
                        <td align="left">
                        <input type="submit" name="confirmer_empl" value="confirmer" style="min-width: 185px"></td>

                        <td></td>
                        
                    </tr>

                </table>
            </form>
            <center> <h3 style="text-align: center; text-transform: lowercase;"><br><br><br><br><br> <?php echo $msg_empl; ?></h3></center>

        </fieldset>



       

      




        <br><br>

    </div>



</body>


</html>