<?php
include "db_conn.php";

session_start();

 $date="";
  $sql ="SELECT * from compte where id='".$_SESSION['id']."';";
  $result= mysqli_query($conn,$sql);
  $r=$result->fetch_assoc();
  $numcp=$r['numcp'];
  
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
   
             if ($_POST['selectdate'] != "" && isset($_POST['actualiser'])){
                 $date= " and ".$date;
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


        <form class="form-style-1" method="POST" action="operation_.php">
            <table class="menu"  border="0" style="padding-left: 30%">
                <br><br>
                <tr>
                    <td colspan="3" style="min-width: 200px">
                       &ensp;
                    </td>
                   


                    <td>
                     &ensp;
                    </td>
                    <td colspan="3">
                        &ensp;
                    </td>
                    <td>
                        <label class="select" for="slct">
                            <select id="slct" name="selectdate">
                                <option value="" selected>Date</option>
                                <option value="aujourdhuit">Aujourd'huit</option>
                                <option value="semaine">Dernier semaine</option>
                                <option value="mois">Dernier mois</option>

                            </select>
                    </td>
                    <td colspan=2>
                        <input type="submit" class="button" id="actualiser" name="actualiser" value="Actualiser">
                    </td>
                </tr>

            </table>
        </form>

        <br><br>
        <table class="s" style="padding-left: 0px" width="100%">

            <thead>
                <td colspan=8>
                    Gestion des Operations
                </td>
            </thead>


            <tr style="background-color: #F7A570;">
                <td >
                    Num Operation
                </td>

                <td >
                    Num compte E
                </td>
                <td>
                    Prenom
                </td>
                <td>
                    Nom
                </td>
                <td>
                    Type
                </td>
                <td>
                    Num compte R
                </td>
                <td>
                    Mantant
                </td>
                <td>
                    Date
                </td>


            </tr>

           
          <?php


    if(isset($_POST['actualiser']) or true)

{

 
  $sql ="SELECT * from operation where numcp=$numcp or numcp2=$numcp $date ORDER BY 1 DESC;";
  $result= mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck>0){
      while($row=mysqli_fetch_assoc($result)){
         
?>
                <tr>
            <td><?php echo $row['numop']; ?></td>
            <td><?php echo $row['numcp']; ?></td>
            <td><?php echo $row['prenom']; ?></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['numcp2']; ?></td>
            <td><?php echo $row['mentant']; ?></td>
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