<?php
    
    $user = $email = $pass = $rePass = $fname = $lname = $adress = $telefon = $class = "";
    $userErr = $emailErr = $passErr = $rePassErr = $fnameErr = $lnameErr = $adressErr = $telefonErr = $classErr = "";

    if(isset($_POST["submit"]))
{
  
        $user = trim($_POST["user"]);				           
        $pass = trim($_POST["pass"]); 
        $rePass = trim($_POST["rePass"]);
        $fname = trim($_POST['forname']);
        $lname = trim($_POST['lastname']);
        $adress = trim($_POST['adress']);
        $telefon = trim($_POST['telefon']);
        $email 	= trim($_POST["email"]);
        $profession = trim($_POST['profession']);
        $class = trim($_POST['class']);
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
            
                
        if (!preg_match("/^[A-Za-z0-9åäöÅÄÖ]*$/",$user)) {
			$userErr = "Only letters and numbers are allowed"; 
		}		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
		
		
		if (empty($_POST["user"])) {
			$userErr = "Username is required";
		}
	    if (empty($_POST["email"])) {
			$emailErr = "Email is required";
	    }
        if (empty($_POST["forname"])) {
            $fnameErr = "Forname is required";   
        }
        if (empty($_POST["lastname"])) {
            $lnameErr = "Lastname is required";   
        }
        if (empty($_POST["adress"])) {
            $adressErr = "Address is required";   
        }
        if (empty($_POST["telefon"])) {
            $telefonErr = "Telephone number is required";   
        }
        if (empty($_POST["class"])) {
            $classErr = "Class is required";   
        }
	    if (strlen($_POST["pass"]) < 8) {
			$passErr = "Password is required";
	    }
	    if (strlen($_POST["rePass"]) < 8) {
			$rePassErr = "re-enter password is required";
		}
		if ($_POST["rePass"] != $_POST["pass"]) {
			$rePassErr = "The re-entered password don't match";
		}
        
        if(empty($userErr) && empty($emailErr) && empty($passErr) && empty($rePassErr) && empty($fnameErr) && empty($lnameErr) && empty($adressErr) && empty($telefonErr) && empty($classErr))
    {
    try 
    {
    require_once("../../includes/test.php");
        
        
    $query = "INSERT INTO project (username, password, fname, lname, adress, telefon, email, profession, class_id) ";
    $query .=  "VALUES (:user, :pass, :forname, :lastname, :adress, :telefon, :email, :profession, :class)";
    
    $ps = $db->prepare($query);
    $result = $ps->execute(array('user'=>$user,'pass'=>$hashedPass,'forname'=>$fname,'lastname'=>$lname,'adress'=>$adress,'telefon'=>$telefon,'email'=>$email,'profession'=>$profession,'class'=>$class));
        
    
    if($result)
    {
        echo "<script>alert(\"Succeed\")</script>";
    }
    else
    {
        echo "<script>alert(\"Failed\")</script>";
    }
    }
    catch(Exception $exception)
    {
        echo "Epic fail: <br /><br />";
        echo $exception."<br /><br />";
    }
    }
    }
    try{
        require_once("../../includes/test.php");
        
        $query = "SELECT * FROM project ";
        
        			
				$ps = $db->prepare($query); 
						
				$result = $ps->execute(); 
				$users = $ps->fetchAll();
        
    }
   catch(Exception $exception)
    {
        echo "Epic fail: <br /><br />";
        echo $exception."<br /><br />";
    }
   include('Header.php');
?>
<div class="container">
    <div class="jumbotron">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <h1>Manage accounts</h1>
	       <form>
	           <input type="text" size="30" onkeyup="showResult(this.value)">
	       </form>
	   <div id="list"></div>
        </a>
        </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
        <div class="row">
        <div class="col-md-6">
            <table class="table">
		    <thead>
			<th>Username</th>
            <th>Förnamn</th>
			<th>Efternamn</th>
			<th>Options</th>
		    </thead>
            <?php
            foreach($users as $user){
			echo "<tr>";
			echo "<td>". $user['username'] . "</td><td>" . $user['fname'] . "</td><td>" . $user['lname'] . "</td><td><a href='#'> Delete</a></td>";
			echo "</tr>";
		    }
            ?>
            </table>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Sign up User
        </a>
        </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
        <form class="form-horizontal col-md-4 col-md-offset-5" role="form" action="sigup.php" method="POST">
        <div class="form-group">
           <input type="text" class="form-controll" id="user" name="user" placeholder="Username"><span class="error">* <?php echo $userErr; ?></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-controll" id="pass" name="pass" placeholder="Password"><span class="error">* <?php echo $passErr; ?></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-controll" id="rePass" name="rePass" placeholder="rePassword"><span class="error">* <?php echo $rePassErr; ?></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="forname" name="forname" placeholder="Förnamn"><span class="error">* <?php echo $fnameErr; ?></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="lastname" name="lastname" placeholder="Efternamn"><span class="error">* <?php echo $lnameErr; ?></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="adress" name="adress" placeholder="Address"><span class="error">* <?php echo $adressErr; ?></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="telefon" name="telefon" placeholder="Telefon"><span class="error">* <?php echo $telefonErr; ?></span>
        </div>
        <div class="form-group">
            <input type="email" class="form-controll" id="email" name="email" placeholder="Email"><span class="error">* <?php echo $emailErr; ?></span>
        </div>
        <div class="form-group">
            <select name="profession">
            <option value="">Please select user profession</option>
            <option value="0">Student</option>
            <option value="1">Teacher</option>
            <option value="2">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <select name="class">
            <option value="">Please select user class</option>
            <option value="1">WUK14</option>
            <option value="2">PTK14</option>
            <option value="3">COB14</option>
            <option value="4">PRL14</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="sign up">
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="form-group col-md-4 col-md-offset-5">
            <button type="button" class="btn btn-default"><a href="../om/Profil.php">Till Profil</a></button>
        </div>
    </div>
</div>
