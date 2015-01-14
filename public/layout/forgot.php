<?php
    
    if(isset($_POST["submit"]))
    {
        
    
        $username = $_POST['inputUser'];
        $password = $_POST['inputPassword'];
        $repass = $_POST['rePassword'];
        
        if(isset($_POST['inputPassword'])&&isset($_POST['rePassword']))
        {
            if($password === $repass)
            {
        
                try 
                {
                    require_once("../../includes/test.php");
            
                    $query = "UPDATE project ";
                    $query .=  "SET password = :password ";
                    $query .= "WHERE username = :username";
        

                    $ps = $db->prepare($query);
                    $result = $ps->execute(array('password'=>$password,'username'=>$username));
            
                        if($result)
                        {
                            echo "Update success!";
                        }
                        else
                        {
                            echo "Update fail!";
                        }
                }
                catch(Exception $exception)
                {
                    echo "Epic fail: <br /><br />";
                    echo $exception."<br /><br />";
                }
                
            }
        }
    }
    include('Header.php');
    ?>

<div class="container"style="margin-top: 100px;">
        <form class="form-horizontal col-md-4 col-md-offset-5" role="form" action="forgot.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-controll" id="inputUser" name="inputUser" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-controll" id="inputPassword" name="inputPassword" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-controll" id="inputPassword" name="rePassword" placeholder="rePassword">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="apply">
                <button><a href="login.php">back</a></button>
            </div>
    </form>
</div>
