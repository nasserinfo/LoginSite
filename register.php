<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="container">
<form method="POST">
  Name: <input class="form-control" type="texte" name="name" required/> <br>
  LastName: <input class="form-control" type="texte" name="lastname" required/><br>
  Date: <input class="form-control" type="date" name="daten" required/><br>
  Email: <input class="form-control" type="email" name="email" required/><br>
  Password: <input class="form-control" type="password" name="password" required/><br>
  <button class="btn btn-dark" type="submit" name="register" >Register</button>
</form>
</form>
<form method="POST">
<button type="submit" name="PriorLogin" class="btn btn-info">Login</button><br>
</form>
</div>

<?php
$database = new PDO("mysql: host=localhost; dbname=dred; sharset=utf8;","root","");

if(isset($_POST['register'])){
  $CheckEmail=$database->prepare("SELECT * FROM register where email=:email");
  $email=$_POST['email'];
  $CheckEmail->bindParam("email",$email);
  $CheckEmail->execute();
  if($CheckEmail->rowCount()>0){
  echo '<div class="alert alert-danger" role="alert">
   Email existe déja!  
  </div>';
  }else{
    $name=$_POST['name'];
    $lastname=$_POST['lastname'];
    $daten=$_POST['daten'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $adduser=$database->prepare("INSERT INTO register(nom,prenom,datenais,email,motspasse,securite_code) VALUES(:nom,:prenom,:datenais,:email,:motspasse,:securite_code)");
    $adduser->bindParam("nom",$name);
    $adduser->bindParam("prenom",$lastname);
    $adduser->bindParam("datenais",$daten);
    $adduser->bindParam("email",$email);
    $adduser->bindParam("motspasse",$password);
    $codes=rand(100000,999999);
    $adduser->bindParam("securite_code",$codes);
  }

    if($adduser->execute()){
      header("Location: verification.php?update=".$email);
      require_once 'mail.php';
$mail->setFrom('nassereddine26@gmail.com', 'Nasser WebAppl');
$mail->addAddress($email);               //Name is optional
$mail->Subject = "Confirmation compte";
$mail->Body    = '<h1>Veuillez confirmer votre email Code :'.$codes.'</h1>';
$mail->send();

    echo '<div class="alert alert-success" role="alert">
   Votre compte est créer 
  </div>';
  }else{
    echo '<div class="alert alert-danger" role="alert">
    Une erreur est servenu ...! 
   </div>';
  }
}
if(isset($_POST['PriorLogin'])){
  header("Location: login.php");
}
?>




 




  


