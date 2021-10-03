<?php
include "db_conn.php";

session_commit();

session_destroy();

session_start();


        if (isset($_POST["id_name"]))
         {

            if ($_POST["id_name"] !="" ){
           
            $sql = "SELECT * FROM connexion where user='".$_POST["id_name"]."' and password ='".$_POST["password"]."'";
            
         	
         	  $result = $conn->query($sql);
          	$res = $result->fetch_assoc();

          

            
          	$_SESSION['id']=$res['id'];
            $_SESSION['password']= $_POST['password'];

            
          	
          	if ($_SESSION['id'] == ""){header("Location:index.php");}

          	if($res['type'] =="client") {

              $sql1 = "SELECT * FROM compte where id='".$_SESSION['id']."'";
              $result1 = $conn->query($sql1);
              $res1 = $result1->fetch_assoc();
              $_SESSION['numcp']=$res1['numcp'];
              $_SESSION['name']=$res1['prenom']." ".$res1['nom'];
              $_SESSION['solde']=$res1['solde'];

              header("Location:Accueil_.php");}

         
           if($res['type'] =="employes")
            
               {header("Location:Accueil.php");}

       }
       else{

        header("Location:index.php");

       }


}





?>