<?php
include "db_conn.php";
session_start();


$msg_id="";
$id="";
$user="";
$msg="";



        if (isset($_POST["sub"]))
         {
            if (isset($_POST['id'])){
                $id=$_POST['id'];
                $password=$_POST['password'];
                $user=$_POST['user'];

                $sql = "SELECT * FROM employes where id='$id'";
                $result = $conn->query($sql);
                $res = $result->fetch_assoc();
               
                
                $sql2 = "SELECT * FROM client where id='$id'";
                $result2 = $conn->query($sql2);
                $res2 = $result2->fetch_assoc();
               


                    if (isset($res['id'])){
                        
                        //employe
                        $sql1 = "SELECT * FROM connexion where id='$id'";
                        $result1 = $conn->query($sql1);
                        $res1 = $result1->fetch_assoc();
                       
                        if (isset($res1['id'])){

                        $msg_id="Vous avez deja un compte !";
                        
                    }else{

                            $sql_user = "SELECT * FROM connexion where user='$user'";
                            $resu = $conn->query($sql_user);
                            $r = $resu->fetch_assoc();
                            
                            if (empty($r['id'])){

                                $sql_insert = "insert into connexion values ('$id','$user','$password','employes')";
                                
                                if (mysqli_query($conn,$sql_insert)){
                                    $msg = "Inscription Réussite :)";
                                }else {
                                    $msg = "Probleme d'inscription";
                                }
                              }else{
                                $msg_id="Nom d'utilisateur existe";
                              }
                            }

                    }

                   else if (isset($res2['id'])){
                       
                        //client
                        $sql1 = "SELECT * FROM connexion where id='$id'";
                        $result1 = $conn->query($sql1);
                        $res1 = $result1->fetch_assoc();

                        if (isset($res1['id'])){

                        $msg_id="Vous avez deja un compte !";
                        
                        }else{

                            $sql_user = "SELECT * FROM connexion where user='$user'";
                            $resu = $conn->query($sql_user);
                            $r = $resu->fetch_assoc();
                            
                            if (empty($r['id'])){

                                $sql_insert = "insert into connexion values ('$id','$user','$password','client')";
                                
                                if (mysqli_query($conn,$sql_insert)){
                                    $msg = "Inscription Réussite :)";
                                }else {
                                    $msg = "Probleme d'inscription";
                                }
                              }else{
                                $msg_id="Nom d'utilisateur existe";
                              }
                            }

                    }else{
                        $msg_id="Compte n'existe pas !";
                    }
                
           
          
            
}}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_login.css">

</head>

<body>
    <script>

        function p() {

            document.getElementById("position").style.transform = "translateX(100%)";



        }
        function p2() {
            document.getElementById("position").classList.add("login");

            document.getElementById("position").style.transform = "translateX(0%)"
        }
        function verif() {

            window.open("Accueil.html", "_self");
            if (document.getElementById("nom").value == "admin") {
                window.location.href("http://google.com");

            }
        }


    </script>
    <center><h1>Gestion Compte Bancaire</h1></center>
    <div class="container">
        <div class="message signup" id="position">
            <div class="btn-wrapper">
                <button class="button" id="signup" onclick="p()">Créer un compte</button>
                <button class="button" id="login" onclick="p2()">connexion</button>
            </div>
        </div>
        <div class="form form--signup">
            <div class="form--heading">Bienvenue!</div>
            <form method="POST" action="index.php">
                <input type="text" name="id" placeholder="ID" value="<?php echo $id; ?>" required>
                <center style="color: red;"><?php echo $msg_id.$msg; ?></center>
                <input type="text" name="user" placeholder="Nom d'utilisateur" value="<?php echo $user; ?>" required><br>
                <input type="password" name="password" placeholder="Mot de passe" required><br>
                <input type="submit" class="button" name="sub" value="S'inscrire">
            </form>
        </div>
        <div class="form form--login">
            <div class="form--heading">Bienvenue à nouveau!</div>
            <form method="POST" action="verif.php" name="login">
                <input type="text" id="nom" placeholder="Nom d'utilisateur" required name="id_name"><br>
                <input type="password" placeholder="Mot de passe" name="password" required><br>
                <input type="submit" class="button" value="Connecter">
             
            </form>
        </div>
    </div>

</body>
</html>