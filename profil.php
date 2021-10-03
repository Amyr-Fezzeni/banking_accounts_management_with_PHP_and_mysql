<?php include "db_conn.php";
session_start();

$id=$_SESSION['id'];

if (isset($_POST['valider'])) {


    $query_update= "UPDATE employes SET prenom='".$_POST['prenom']."', nom='".$_POST['nom']."', tel='".$_POST['tel']."', mail='".$_POST['mail']."', sexe='".$_POST['sexe']."', date_n='".$_POST['date_n']."', pays='".$_POST['pays']."', ville='".$_POST['ville']."', adresse='".$_POST['adresse']."',agence='".$_POST['agence']."'  where id='$id'";
    
    mysqli_query($conn, $query_update);
    
}


    $sql_image = "SELECT * FROM images where id_client='$id'  ORDER BY 1 DESC limit 1";   
       
     $result_image = $conn->query($sql_image);
     $res_image = $result_image->fetch_assoc();  
  
     if ($res_image['image'] != "" ){

        $profile_image =  $res_image['image']; 
         
     }
     else
     {
         $profile_image = "img/profile_big.png";  
     }
   
    

  
if ($id =="") {$id="1";}
    $sql = "SELECT * FROM employes where id=".$id." ";
    $result = $conn->query($sql);
    $res = $result->fetch_assoc();
    
    

if (isset($_POST['upload_image'])) {

    $image = $_FILES['image']['name'];
   
    
    $target = "upload/".basename($image);
  
    $sql3 = "INSERT INTO images (id_client,image) VALUES ('$id','$target')";

    mysqli_query($conn, $sql3);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";

    }

    else
    
    {
        $msg = "Failed to upload image";
    }

}
if (isset($_POST['password_reset'])) {
    $new_pass=$_POST['npass'];
    $query_pass= "UPDATE connexion SET password='$new_pass' where id='$id'";
    
    mysqli_query($conn, $query_pass);
    $_SESSION['password']=$new_pass;
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
        var i=1;
        var j=0;
        


        function modif(){

            if (j%2==0){
                document.getElementById("valider").style.display = "block";
            document.getElementById("prenom").disabled = false;
            document.getElementById("nom").disabled = false;
            document.getElementById("id").disabled = false;
            document.getElementById("tel").disabled = false;
            document.getElementById("mail").disabled = false;
            document.getElementById("sexe").disabled = false;
            document.getElementById("date_n").disabled = false;
            document.getElementById("pays").disabled = false;
            document.getElementById("ville").disabled = false;
            document.getElementById("adresse").disabled = false;
            document.getElementById("agence").disabled = false;
                j=j+1;
                
            }
            else
            {   
                 document.getElementById("valider").style.display = "none";
            document.getElementById("prenom").disabled = true;
            document.getElementById("nom").disabled = true;
            document.getElementById("id").disabled = true;
            document.getElementById("tel").disabled = true;
            document.getElementById("mail").disabled = true;
            document.getElementById("sexe").disabled = true;
            document.getElementById("date_n").disabled = true;
            document.getElementById("pays").disabled = true;
            document.getElementById("ville").disabled = true;
            document.getElementById("adresse").disabled = true;
            document.getElementById("agence").disabled = true;
                j=j+1;
                
            }
            
           

            
        }


        function upload() {
           

            document.getElementById("realfile").click();
            document.getElementById("upload_image").style.display = "block";
        }

        function change_password() {
            
        if (i%2!=0){
                document.getElementById('p1').hidden=false;
                document.getElementById('p2').hidden=false;
                document.getElementById('p3').hidden=false;
                i=i+1;
                
            }
            else
            {   
                document.getElementById('p1').hidden=true;
                document.getElementById('p2').hidden=true;
                document.getElementById('p3').hidden=true;
                i=i+1;
                
            }
           

        }

       

        function verif_password(){
            
            var pass=document.getElementById('p').value;

            var oldpass= document.getElementById('oldpass').value;

            var npass= document.getElementById('npass').value;

            var cpass= document.getElementById('cpass').value;
            // alert(pass);
            // alert(oldpass);
            // alert(npass);
            // alert(cpass);
            

            if (pass != oldpass)
                {
                    alert("Mot de passe incorrect !");
                    document.getElementById('oldpass').focus=true;


                    return false;
                }
                else if (npass != cpass){
                    alert("Nouveau mot de passe n'est pas identique !");

                    return false;
                } 
            else 

                { 
                  
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

            <form class="form-style-1" name="profileform" method="POST" action="profil.php"
             enctype="multipart/form-data" >



           
                <table border="0">
                    <tr>
                        <td> Prenom : </td>

                        <td align="left">
                            <input type="text" id="prenom" name="prenom" 
                         value="<?php echo $res["prenom"];?>" 
                         style="min-width: 254px;" disabled >
                    </td>

                        <td style="min-width: 160px;" rowspan="6" align="center">
                            <fieldset>
                                   <?php echo "<img src='".$profile_image."' style='
                                   height: 190px; 
                                    border-radius: 150px 150px; 
                                    margin-top:10px;
                                    margin-bottom:0px;' >"; ?>


                            </fieldset>
                        </td>


                    </tr>

                    <tr>

                        <td style="width: 190px"> Nom : </td>


                        <td align="left"><input type="text" name="nom" id="nom" disabled value="<?php echo $res["nom"] ; ?>" style="min-width: 254px;"></td>
                    </tr>

                    <tr>
                        <td> ID :</td>

                        <td align="left"><input type="text" name="id" id="id" disabled value="<?php echo $res["id"] ; ?>"style="min-width: 254px;"></td>
                    </tr>

                    <tr>
                        <td> Telephone :</td>

                        <td align="left"><input type="text" id="tel" name="tel" disabled value="<?php echo $res["tel"] ; ?>" style="min-width: 254px;">
                        </td>
                    </tr>

                    <tr>
                        <td> Email :</td>

                        <td align="left"><input type="email" id="mail" name="mail" disabled value="<?php echo $res["mail"] ; ?>" 
                                style="min-width: 254px;"></td>

                    </tr>

                    <tr>
                        <td> Sexe :</td>

                        <td align="left"><input type="text" name="sexe" id="sexe" disabled value="<?php echo $res["sexe"] ; ?>" style="min-width: 254px;">

                    </tr>

                    <tr>
                        <td> Date naissance : </td>
                        <td align="left">
                            <input type="text" name="date_n" id="date_n" disabled value="<?php echo $res["date_n"] ; ?>"style="min-width: 254px;"></td>

                        <td align="center" rowspan=2>
                            <input type="button" value ="Importer une image" onclick="upload()"><br>

                            <input type="submit" id="upload_image" value="Upload" name="upload_image" style="display: none;">

                            <input type="file" id="realfile" name="image" hidden="hidden" onchange="ch()">

                        </td>


                    </tr>

                    <tr>
                        <td> Pays :</td>
                        <td align="left"><input type="text" id="pays" disabled name="pays" value="<?php echo $res["pays"] ; ?>"  style="min-width: 254px;"></td>

                    </tr>

                    <tr>
                        <td> Ville :</td>
                        <td align="left"><input type="text" disabled name="ville" id="ville" value="<?php echo $res["ville"] ; ?>"  
                            style="min-width: 254px;">
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td> Adresse :</td>

                        <td align="left" rowspan="2">

                            <textarea rows="4" cols="32" disabled id="adresse" name="adresse"><?php echo $res["adresse"] ; ?></textarea>

                        </td>
                        <td></td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td> Agence :</td>

                        <td align="left">

                            <input type="text" disabled name="agence" id="agence" value="<?php echo $res["agence"] ; ?>"  
                            style="min-width: 254px;">

                        </td>
                        <td></td>
                    </tr>

                    
                    <tr>
                        <td height=50px></td>
                        <td align="center"> <input type="submit" value="Valider" name="valider" id="valider" 
                            style="margin-left:23px; 
                                   display :none;   "  >

                        </td>
                        <td align="right"><input type="button" value="  Modifier vos donnée  "
                            onclick="modif()" > </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="right"><input type="button" value="Changer mot de passe"
                            onclick="change_password()"></td>

                    </tr>
            </form>
            <form class="form-style-1" method="POST" action="profil.php" 
                    onsubmit="return verif_password()" >
                    <tr hidden="true" id="p1">
                        <td >
                            Ancien mot de passe :
                        </td>
                        <td><input type="password" id="oldpass" ></td>
                        <td align="right"></td>

                    </tr>
                    <tr hidden="true" id="p2">
                        <td >Nouveau mot de passe :</td>
                        <td>
                            
                            <input type="password" id="npass" name="npass">
                            <input type="hidden" id="p"
                             value="<?php echo $_SESSION['password']; ?>">

                        </td>
                        <td align="right"></td>

                    </tr>
                    <tr hidden="true" id="p3">
                        <td>Confirmer mot de passe :</td>
                        <td colspan="2">

                            <input type="password" id="cpass" name="newpassword">
                            <input type="Submit" name="password_reset" value="Confirmer" style="margin-left: 30px ;">

                        </td>


                    </tr>

                </table>









            </form>
        </fieldset>







    </div>
    <br><br>


</body>

</html>