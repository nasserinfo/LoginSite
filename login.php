

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<form method="POST">
User Name : <input type="text" name="username" required/> <br>
---------------------<br>
Password : <input type="password" name="password" required/><br>
-----------------------<br> 
<button type="submit" name="login" class="btn btn-info">Login Site</button><br>

</form>
<form method="POST">
<button type="submit" name="CreateUser" class="btn btn-info">ِCreat eUser</button><br>
</form>
<?php
////////////////////////////////////////////////////////////////////////////////////////////
$database = new PDO("mysql: host=localhost; dbname=dred; sharset=utf8;","root","");

  ////////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['login'])){
$dataUsers=$database->prepare("SELECT * FROM register where email=:email and motspasse=:motspasse");
$email=$_POST['username'];
$dataUsers->bindParam("email",$email);
$dataUsers->bindParam("motspasse",$_POST['password']);
$dataUsers->execute();

 if($dataUsers->rowCount()>0){
foreach($dataUsers AS $GetdataUsers){
    $getuser=$_POST["username"];
    $getpassword=$_POST["password"];

if($getuser===$GetdataUsers['email'] && $getpassword===$GetdataUsers['motspasse']) {
    session_start();
    $_SESSION['USER']=$GetdataUsers['email'];
    $_SESSION['PASSWORD']=$GetdataUsers['motspasse'];
    $_SESSION['LOGIN']=true;
    
    //echo ("<script> location.replace('index.php?email='.$getuser) </script>");
     header("Location: index.php?loginEmail=".$GetdataUsers['email']);

}
}
}else{
    echo "Données non validés";

}
}
if(isset($_POST['CreateUser'])){
    header("Location: register.php");
}
// https://www.youtube.com/watch?v=KX9uYapLbnE&list=PLMTdZ61eBnypZGBMDMGYI48WfZEyAgQK_&index=39
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

