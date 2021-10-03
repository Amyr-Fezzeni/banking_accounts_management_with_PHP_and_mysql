<?php
include_once 'db_conn.php';
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href=".\css\form.css">


    <script type="text/javascript">



        
            function chercher(){

                if (document.getElementById('slct').value !="" ){


                    document.getElementById('chtxt').disabled= false;
                    document.getElementById('chbtn').disabled= false;


                }else {
                    document.getElementById('chtxt').disabled= true;
                    document.getElementById('chbtn').disabled= true;


                }
                


            }


    </script>






</head>

<body>



    <div class="navbar">


        <a href="index.html"><img src=".\img\log.png"></a>
        <a href="profil.html"><img src=".\img\profile.png"></a>



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

        <form class="form-style-1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <table class="menu"  style="padding-left: 30%">
                <br><br>
                <tr>
                    <td colspan="3">
                       
 
                        <input type="submit" class="button" name="chbtn" id="chbtn" value="Chercher" disabled="true">
                    </td>
                   
                    <td colspan="3">
                        <input type="text" name="chtxt" id="chtxt" value="" placeholder="Chercher"  disabled="true">
                    </td>

                    <td>
                        <label class="select" for="slct">
                            <select id="slct" name="selectch"  onchange="chercher()">
                                <option value="" selected>selectionner</option>
                                <option value="id">Id</option>
                                <option value="prenom">Prenom</option>
                                <option value="nom">Nom</option>
                                <option value="tel">Tel</option>
                                <option value="pays">Pays</option>
                                <option value="ville">Ville</option>
                            </select>



                    </td>
                    <td colspan=2>
                        <input type="submit" class="button" name="actualiser" id="actualiser" value="Actualiser">
                    </td>
                </tr>

            </table>
        </form>
        <br><br>


        <table class="s" style="padding-left: 0px" width="100%">

            <thead>
                <td colspan=10>
                    Gestion des clients
                </td>
            </thead>


            <tr style="background-color: #F7A570;">
                <td style="max-width: 20px; ">ID</td>
                <td>Prenom</td>
                <td>Nom</td>
                <td>Tel</td>
                <td style="min-width: 90px; ">Date_N</td>
                <td>Sexe</td>
                <td>Email</td>
                <td>Pays</td>
                <td>Ville</td>
                <td style="max-width: 70px; ">Adresse</td>
            </tr>

<?php



 if(isset($_POST['chbtn']))
    {
        
        $s=$_POST['selectch'];
        $ch=$_POST['chtxt'];

        $sql ="SELECT * from client where $s ='$ch'";
        $query_run=mysqli_query($conn,$sql);
        

        while($row=mysqli_fetch_array($query_run))
        {
            ?>

            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['tel']; ?></td>
            <td><?php echo $row['date_n']; ?></td>
            <td><?php echo $row['sexe']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['pays']; ?></td>
            <td><?php echo $row['ville']; ?></td>
            <td><?php echo $row['adresse']; ?></td>
            
            </tr>
            <?php
        }

    }

       else if(isset($_POST['actualiser']) or true)
{
  $sql ="SELECT * from client;";
  $result= mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck>0){
      while($row=mysqli_fetch_assoc($result)){
         
?>
            <tr>
            <td class="s"><?php echo $row['id'];?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['tel']; ?></td>
            <td><?php echo $row['date_n']; ?></td>
            <td><?php echo $row['sexe']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['pays']; ?></td>
            <td><?php echo $row['ville']; ?></td>
            <td><?php echo $row['adresse']; ?></td>
            
            </tr>
            <?php
        }
    }
}

   
  ?>
  
            

        </table>








        <br><br>


</body>

</html>