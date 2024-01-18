<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<?php
  
  $database = new PDO("mysql: host=localhost; dbname=dred; sharset=utf8;","root","");

  echo '<div class="alert alert-success" role="alert">
  <form method="POST">
  Code validation est envoyé à votre email : '.$_GET['update'].'  <input type="number" name="CodeValidation"><br>
<button type="submit" name="btnvalidation">Validé Mon compte</button>
   </form>
  </div>';   
  if(isset($_POST['btnvalidation'])){
  $Getcode=$database->prepare("SELECT * FROM register where email=:email");
  $Getcode->bindParam("email",$_GET['update']);
  $Getcode->execute();
  
  foreach($Getcode AS $code){
    if ( $code['securite_code']==$_POST['CodeValidation']){
      $Getcode=$database->prepare("UPDATE register SET activation=:activ where email=:email");
      $Getcode->bindParam("email",$_GET['update']);
      $code1=1;
      $Getcode->bindParam("activ",$code1);    
      $Getcode->execute();    
      header("Location: register.php");
          }else{
    echo '<h1>Code non valide</h1>';
  }
  }
  
}

?>




 




  


