<?php 

    include('Header.php'); 
    session_start();
    
    if(isset($_POST["submit"]))
    {
        $username = $_POST['inputUser'];
        $password = $_POST['inputPassword'];
    
   

        try 
        {
        require_once("../../includes/test.php");
            
        $query  = "SELECT * ";
        $query .= "FROM project ";
        $query .= "WHERE username = :inputUser";
        /*$query .= "AND password = :inputPassword";*/

        $ps = $db->prepare($query);
        $result = $ps->execute(array('inputUser'=>$username));
        
        $user = $ps->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            if(password_verify($password, $user['password']))
            {
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['forname'] = $user['fname'];
                $_SESSION['lastname'] = $user['lname'];
                $_SESSION['adress'] = $user['adress'];
                $_SESSION['telefon'] = $user['telefon'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['profession'] = $user['profession'];
                $_SESSION['class_id'] = $user['class_id'];
                header("Location: ../om/Home.php");
            }
        }
        else
        {
            echo "<script>alert(\"wrong password/username\")</script>";
        }
        }
        catch(Exception $exception)
        {
            echo "Epic fail: <br /><br />";
            echo $exception."<br /><br />";
        }
       
    
        
    }
	
		/*if(isset($_POST["submit"])){
			$_SESSION['timestamp'] = time();
			$_SESSION['username'] = $_POST['inputUser'];
			header("Location: autoLogout.php"); //redirect to autoLogout.php
			exit;
		}*/
	
    


?>  
<div class="container" style="margin-top: 100px;">
    <form class="form-horizontal col-md-4 col-md-offset-5" role="form" action="login.php" method="post">
        <div class="form-group">
           <input type="text" class="form-controll" id="inputUser" name="inputUser" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-controll" id="inputPassword" name="inputPassword" placeholder="Password">
        </div>
        <div class="form-group">
           
            <a href="forgot.php">Forgot Password</a>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" id="myButton" name="submit" value="Submit">
        </div>
    </form>
</div>