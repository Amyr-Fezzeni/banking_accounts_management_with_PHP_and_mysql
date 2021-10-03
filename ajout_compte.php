<?php
include "db_conn.php";
$id= "";
$prenom="";
$nom="";
$date_n="";
$tel="";
$mail= "";
if (isset($_POST["chercher"]) ) 
{
    if ($_POST["id"]!="")
     { 
        $id = $_POST["id"];

        $sql = "SELECT * FROM client where id=$id ";
        $result = $conn->query($sql);
        $res = $result->fetch_assoc();
        
        $prenom=$res['prenom'];
        $nom=$res['nom'];
        $date_n=$res['date_n'];
        $tel=$res['tel'];
        $mail= $res['mail'];
     }

}  

 
$msg="";
if (isset($_POST["valider"]) ){
        $id = $_POST["id_"];
        $solde = $_POST['solde'];

        $sql = "SELECT * FROM client where id=$id ";
        $result = $conn->query("SELECT * FROM client where id=$id ");
        $res = $result->fetch_assoc();
        
        $prenom=$res['prenom'];
        $nom=$res['nom'];
        $date_n=$res['date_n'];
        $tel=$res['tel'];
        $mail= $res['mail'];

        $sql_chek = "SELECT * FROM compte where id=$id ";
        $result_check = $conn->query($sql_chek);
        $res_check = $result_check->fetch_assoc();
        if ($res_check['id'] !=""){

            $msg= "Vous aver deja un compte !";

        }
        else{
            
      
    $sql_compte= "INSERT INTO compte (id, prenom, nom, solde) VALUE ('$id','$prenom','$nom',$solde)";
    if (mysqli_query($conn, $sql_compte)){
        $msg= "Compte ajoutée avec succée !";
    }
        else{
            $msg= "Problem reconnue !";
        }


  }
  
}


?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href=".\css\form.css">

</head>

<body>

    <script>
        function valid(){

           document.getElementById('id_').value=document.getElementById('id').value;;

         
           return true;

        }

        function verif_solde(){
            var solde = document.getElementById('solde').value;
            var prenom =  document.getElementById('prenom').value;
            var id = document.getElementById('id_').value;
            

            if ((solde !="") && (solde>=0)){
                

                        if ((id !="") && (prenom !="") ){
                             
                              return true;
                            }
                }
              

            
            alert('Invalide data !');

            
            return false;
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


        <form class="form-style-1" method="POST" name="gestion_comptes" action="ajout_compte.php" onsubmit="return valid()" >
            <fieldset align="center">
                <leegend><h1>Gestion Du Compte</h1></leegend>
                <center><h1><?php echo $msg; ?></h1> </center>

                
                <table border="0">
                <tr>    
                    <td> 
                        <table border="0" style="text-align: left;">
                            <tr>
                                <td style="min-width: 200;">ID Client : </td>
                                <td><input type="text" name="id" id="id" placeholder="ID Client" value="<?php echo $id; ?>"></td>
                                <td></td>
                            
                                <td style="text-align: left;" ><input type="submit" name="chercher" value="Recherche"  ></td>
                          
                            </tr>

                        </form>
                            <tr>
                                <form class="form-style-1" method="POST" action="ajout_compte.php" onsubmit="return verif_solde()">
                                  <td>Solde initial : </td>
                                  <td><input type="text" name="solde" id="solde"></td>
                                  <td><input type="hidden" name="id_" id="id_" value="<?php echo $id; ?>" ></td>
                                  <td style="text-align: left;" ><input type="submit" name="valider" value="Valider"></td>
                                </form>
                            </tr>
                    
                        </table>

                    

                    </td>
                </tr>

                    <br>

                <tr><form class="form-style-1">

                        <td>
                            <table border="0" style="text-align: left ;">
                        </td>

                <tr>
                        <td>Prénom:</td>
                        <td><input type="text" id="prenom" name="Prénom" value="<?php echo $prenom; ?>" disabled> </td>
                </tr>
                            
                <tr>
                        <td>Nom : </td>
                        <td><input type="text" name="Nom" value="<?php echo $nom; ?>" disabled></td>
                </tr>

                <tr>
                        <td>Date de naissance :</td>
                        <td><input type="text" value="<?php echo $date_n; ?>" disabled></td>
                        <td style="min-width: 290px;"></td>
                            
                            
                </tr>

                <tr>
                        <td>Tél :</td>
                        <td><input type="text" name="Tél" value="<?php echo $tel; ?>" disabled></td>
                </tr>

                <tr>
                        <td> Email : </td>
                        <td><input type="email" id="email"  value="<?php echo $mail; ?>" disabled> </td>
                </tr>

                    </table>
                </tr>
                </table>

         
         
         
         
         
         
         
         
         
            </fieldset>
        </form>
    


        <br><br>


</body>

</html>