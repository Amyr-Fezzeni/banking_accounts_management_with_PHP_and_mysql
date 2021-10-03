<?php
include 'db_conn.php';
    echo "value : ".$_POST['chbtn'];

    if(isset($_POST['chbtn']))
    {
        
  


        $query="SELECT * FROM client where id = '".$_POST['chtxt']."' ";
        echo $query ;
        $query_run = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($query_run))
        {
            

                         echo $row['id']; 
                        echo $row['prenom']; 
                        echo $row['nom']; 
                        echo $row['tel']; 
                        echo $row['date_n'];

                        echo $row['sexe']; 
                        echo $row['mail']; 
                        echo $row['pays']; 
                        echo $row['ville']; 
                        echo $row['adresse']; 

          
       
        }

    }else
    {
        echo "no data";
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


        <a href="index.html"><img src=".\img\log.png"></a>
        <a href="profil.html"><img src=".\img\profile.png"></a>



        <div class="dropdown">
            <button class="dropbtn">Ajouter<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Client</a>
                <a href="#">Compte</a>
                <a href="#">Employer</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Modifier<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Client</a>
                <a href="#">Employer</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Suprimer<i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Client</a>
                <a href="#">Compte</a>
                <a href="#">Employer</a>
            </div>
        </div>
        <a href="Accueil.html">Accueil</a>



    </div>

    <div class="sidebar"><br><br><br>
        <a href="gestion_des_clients.html">Gestion des clients</a>
        <br>
        <a href="gestion_des_comptes.html">Gestion des comptes</a>
        <br>
        <a href="gestion_des_operations.html">Gestion d'operation</a>
        <br>
        <a href="gestion_des_employes.html">Gestion d'employes</a>
        <br>
        <a href="gestion_des_reclamations.html">Gestion des reclamations</a>
        <br>
        <a href="gestion_des_cheques.html">Gestion des chéques</a>
        <br>
        <a href="transactions.html">Transactions</a>

    </div>
    <div class="content">

        <form class="form-style-1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <table class="menu" >
                <br><br>
                <tr>
                    <td colspan="3">
                        <input type="submit" class="button" name="chbtn" id="chbtn" value="Chercher">
                    </td>
                    <td>

                    </td>
                    <td colspan="1">
                    </td>
                    <td colspan="3">
                        <input type="text" id="chtxt" name="chtxt" value="" placeholder="Chercher">
                    </td>

                    <td>
                        <label class="select" for="slct">
                            <select id="slct" required="required">
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
                        <input type="button" class="button" id="actualiser" value="Actualiser">
                    </td>
                </tr>

            </table>
        </form>
        <br><br>


        <table class="s">

            <thead>
                <td colspan=10>
                    Gestion des clients
                </td>
            </thead>


            <tr class="sec">
                <td class="sec">
                    ID
                </td>
                <td>
                    Prenom
                </td>
                <td>
                    Nom
                </td>
                <td>
                    Tel
                </td>
                <td>
                    Date_N
                </td>
                <td>
                    Sexe
                </td>
                <td>
                    Email
                </td>
                <td>
                    Pays
                </td>
                <td>Ville</td>
                <td>Adresse</td>
            </tr>
<div id="act">

                <?php


                 if(isset($_POST['chbtn']))
    {
        
  


        $query="SELECT * FROM client where id = '".$_POST['chtxt']."' ";
       
        $query_run = mysqli_query($conn,$query);

        while($row = mysqli_fetch_array($query_run))
        {
            

                        echo "<tr><td>".$row['id']."</td>"; 
                        echo "<td>".$row['prenom']."</td>";
                        echo "<td>".$row['nom']."</td>"; 
                        echo "<td>".$row['tel']."</td>";
                        echo "<td>".$row['date_n']."</td>";

                        echo "<td>".$row['sexe']."</td>"; 
                        echo "<td>".$row['mail']."</td>"; 
                        echo "<td>".$row['pays']."</td>"; 
                        echo "<td>".$row['ville']."</td>";
                        echo "<td>".$row['adresse']."</td></tr>"; 

        }
}
                ?>


        </table>
  
  </div>
            









        <br><br>


</body>

</html>
</label></td></tr></table></form></div></body></html></</</