<?php
include "db_conn.php";

session_start();

  $date="";


if (isset($_POST['selectdate'])){
  
    $date_recherche = $_POST['selectdate'];

    if ($date_recherche == "aujourdhuit") {

        $d=strtotime("today");    
        $date = date("Y-m-d H:i:s", $d);
        $date= " date >= '".$date."' ";

    } else if ($date_recherche == "semaine") {

        $d=strtotime("- 1 week");    
        $date = date("Y-m-d H:i:s", $d);
        $date= " date >= '".$date."' ";

    }else if ($date_recherche == "mois") {
      
        $d=strtotime("- 1 Months");    
        $date = date("Y-m-d H:i:s", $d);
        $date= " date >= '".$date."' ";

    }
   
            if ($_POST['selectdate'] != "" && isset($_POST['chbtn'])){

                    $date= " and".$date;

                 }
             if ($_POST['selectdate'] != "" && isset($_POST['actualiser'])){
                 $date= " where".$date;
                  }
   
}



if(isset($_GET['n']))
{

    $query_update= "UPDATE cheque SET etat='Terminer'  where numch='".$_GET['n']."'";
    
    mysqli_query($conn, $query_update);
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


        <form class="form-style-1" method="POST" action="gestion_des_cheques.php">
            <table class="menu"  style="padding-left: 0px">

                <tr>
                    <td >
                        <input type="submit" id="chbtn" name="chbtn" value="Chercher" disabled="true">
                    </td>
                    <td>
                        <label class="select" for="slct" >
                            <select id="slct" name="selectch" onchange="chercher()">
                                <option value="" selected>selectionner</option>
                                <option value="id">id</option>
                                <option value="id">Num compte</option>
                                <option value="prenom">Prenom</option>
                                <option value="nom">Nom</option>
                                <option value="tel">Etat</option>
                            </select>
                    </td>
                    <td >
                        <input type="text" id="chtxt" name="chtxt" value="" placeholder="Chercher" disabled="true">
                    </td>
                    <td>
                        <label class="select" for="slct" >
                            <select id="slct" name="selectdate">
                                <option value="" selected>Date</option>
                                <option value="aujourdhuit">Aujourd'huit</option>
                                <option value="semaine">Dernier semaine</option>
                                <option value="mois">Dernier mois</option>

                            </select>
                    </td>
                    <td >
                        <input type="submit" class="button" name="actualiser" id="actualiser" value="Actualiser">
                    </td>
                </tr>

            </table>

            <br>

        </form >

         <table class="s" style="padding-left: 0px" width="100%">

            <thead>
                <td colspan=7  style="padding: 10px 30px; text-transform: uppercase;">
                    Gestion des Chéque
                </td>
            </thead>


            <tr style="background-color: #F7A570;">
                <td>
                    Num
                </td>
                <td>
                    Etat
                </td>
                <td style="max-width: 20px; ">
                    ID
                </td>
                <td style="max-width: 40px; ">
                    Num compte
                </td>
                <td>
                    prenom
                </td>
                <td>
                    Nom
                </td>
                <td style="min-width: 80px; ">
                    Date
                </td>

            </tr>

     <?php



 


    if(isset($_POST['chbtn']))
    {
        
        $s=$_POST['selectch'];
        $ch=$_POST['chtxt'];

        $sql ="SELECT * from cheque where $s ='$ch' $date ORDER BY 1 DESC";
        // echo $sql;
        $query_run=mysqli_query($conn,$sql);
        

        while($row=mysqli_fetch_array($query_run))
        {
            ?>

            <tr>
            
            <td><?php echo $row['numch']; ?></td>
            <td> <?php 
                    $num = $row['numch'];
                    if ($row['etat']=="Terminer"){
                        
                    echo "<a href='' ><input type='button' value=' Terminer ' style='color:blue;'></a>" ;

                    }else {

                       echo "<a href='gestion_des_cheques.php?n={$num}' ><input type='button' value='En Attente' style='color:red;'></a>"; 
                   
                    }

                 ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['numcp']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['date']; ?></td>
            
            </tr>
            <?php
        }

    }
        else {

              $sql ="SELECT * from cheque $date ORDER BY 1 DESC";
              $result= mysqli_query($conn,$sql);
              $resultCheck = mysqli_num_rows($result);

              if($resultCheck>0){
                  while($row=mysqli_fetch_assoc($result)){
                     
               ?>
            <tr>
            
            <td><?php echo $row['numch']; ?></td>
            <td>
                 <?php 
                    $num = $row['numch'];
                    if ($row['etat']=="Terminer"){
                        
                    echo "<a href='' ><input type='button' value=' Terminer ' style='color:blue;'></a>" ;

                    }else {

                       echo "<a href='gestion_des_cheques.php?n={$num}' ><input type='button' value='En Attente' style='color:red;'></a>"; 
                   
                    }

                 ?>
                
                
                        
                </td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['numcp']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['date']; ?></td>
                
                
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