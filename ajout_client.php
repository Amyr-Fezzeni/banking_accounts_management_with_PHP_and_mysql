<?php
include "db_conn.php";
 
$id =  "";
$prenom= "";
$nom= "";
$date_n=  "";
$tel="" ;
$mail=  "" ;
$pays= ""; 
$ville="";
$sexe="";
$adresse="";
$msg="";


if (isset($_POST["ajouter"]) ) 



     { 
        $id = $_POST["id"] ;
        $prenom=$_POST["prenom"] ;
        $nom=$_POST["nom"] ;
        $date_n= $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
        $tel=$_POST["tel"] ;
        $mail= $_POST["mail"];
        $pays=$_POST["pays"] ; 
        $ville=$_POST["ville"] ;
        $sexe=$_POST["sexe"] ;
        $adresse=$_POST["adresse"];



        $sql = "SELECT * FROM client where id=$id ";
        $result = $conn->query($sql);
        $res = $result->fetch_assoc();
        

        if (isset ($res['prenom'])){
           $msg="client existe";
        }
        else {

            $sql="INSERT INTO client (prenom, nom, id, mail, tel, sexe, date_n, pays, ville, adresse) 
            VALUES ('$prenom' ,'$nom','$id','$mail','$tel','$sexe','$date_n','$pays','$ville','$adresse')";     
            if (mysqli_query($conn, $sql)) {

                $msg= "Client ajouter avec succée";
                
            }
            









        }
        
     }




  
















?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href=".\css\form.css">


</head>

<body>
    <script>


        function upload() {

            document.getElementById("realfile").click();
        }




        function ch() {

            var image = document.getElementById("realfile").value;
          
          if (image ==""){
            
            return true;
          }

           var test=false;

           var listeimages= ['.jpg','.jpeg','.png'];

           for (var i = 0; i < listeimages.length ; i++) {

              
               if (image.indexOf(listeimages[i]) > 0) {
                   
                    test=true;
                    break;
                 }
           }

           if (test==true){

           
             return true;
           }else {
             
              return false;
           }

           
          
        

           

        }

        function controle_information()
{
    var id = document.getElementById("id").value;
    var tel = document.getElementById("tel").value;
    var sexe = document.getElementById("sexe").value;
    var jour = document.getElementById("jour").value;
    var mois = document.getElementById("mois").value;
    var annee = document.getElementById("annee").value;

    if (ch() == false ){
        return false;
    }
    
    if (id.length !=8 || isNaN(id)) {
        alert ("Id incorrect");
        return false;
    }

    else if (tel.length !=8 || isNaN(tel)) {
        alert ("numero tel incorrect");
        return false;
    }
    else if (sexe == "") {

        return false;
    }

    
    else if (jour=="jour"){
        alert("jour invalide");
        return false;
    }

    else if (mois=="mois"){
        alert ("mois incorrect");
        return false;
    }

    else if (annee=="annee"){
        alert("annee invalide");
        return false;

    }

    else {
        return true;
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



        <fieldset>
            <legend align="center">
                Inscription Client
            </legend>
              <h3 align="center"><?php echo $msg; ?></h3>
            <form class="form-style-1" method="POST" action="ajout_client.php" onsubmit="return controle_information() ">
                <table border="0">
                    <tr>

                        <td style="min-width: 160px;" rowspan="6" align="center">
                            <fieldset>
                                <img src=".\img\profile_big.png" id="profile"
                                    style=" height: 190px; border-radius: 150px 150px; margin-top:10px; margin-bottom:0px;">
                            </fieldset>
                        </td>

                        <td align="center"><input type="text" name="prenom" placeholder="Prenom" required style="min-width: 254px;" >
                        </td>
                    </tr>

                    <tr>




                        <td align="center"><input type="text" name="nom" placeholder="Nom" required style="min-width: 254px;"></td>
                    </tr>

                    <tr>

                        <td align="center"><input type="text" name="id" maxlenght="8" placeholder="Id" required id="id" required style="min-width: 254px;"></td>
                    </tr>

                    <tr>

                        <td align="center"><input type="text" name="tel" maxlenght="8" placeholder="Telephone" required id="tel" required style="min-width: 254px;"></td>
                    </tr>

                    <tr>

                        <td align="center"><input type="email" name="mail"  placeholder="Email" required style="min-width: 254px;">
                        </td>

                    </tr>

                    <tr>

                        <td align="center"> <select class="Sexe" id ="sexe" name="sexe" required  style="min-width: 254px;">
                                <option value="">Selectioner</option>
                                <option value="Homme">Homme</option>
                                <option value="femme">Femme</option>
                            </select></td>
                    </tr>

                    <tr>
                        <td align="center" rowspan=2>
                            <input type="button" id="custom_b" value="Importer une image" onclick="upload()">

                            <input type="file" id="realfile" hidden=hidden onchange="ch()">

                        </td>
                        <td align="center"><select id="mois" name="mois" required>
                                <option value="">Mois</option>
                                <option value="01">Janvier</option>
                                <option value="02">Fevrier</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">juillet</option>
                                <option value="08">Aout</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">Nouvenber</option>
                                <option value="12">Decembre</option>
                            </select>


                            <select id="jour" name="jour"  required>
                                <option value="">Jour</option>
                                <?php 
                                    for ($i=1; $i<32; $i++){

                                        echo "<option value='$i'>$i</option>";
                                    } ?>
                               
                            </select>

                            <select id="annee" name="annee" required>
                                <option value="">Année</option>
                                   <?php 
                                    for ($i=1900; $i<2021; $i++){

                                        echo "<option value='$i'>$i</option>";
                                    } ?>
                            </select>
                        </td>

                    </tr>

                    <tr>

                        <td align="center"><input type="text" name="pays" placeholder="Pays" required  style="min-width: 254px;"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td align="center"><input type="text" name="ville" placeholder="Ville" required  style="min-width: 254px;"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td align="center"><input type="text" name="adresse" placeholder="Adresse" required  style="min-width: 254px;"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td align="center"><br><input type="submit" value="ajouter" name="ajouter">
                            <input type="reset" value="annuler">
                        </td>
                    </tr>

                </table>









            </form>
        </fieldset>







    </div>
    <br><br>


</body>

</html>