<?php
    session_start();
    
    if(isset($_POST["submit"]))
    {
        if(isset($_POST['forname']) && isset($_POST['lastname']) && isset($_POST['adress']) && isset($_POST['telefon']) && isset($_POST['email']))
        {
            $fname = $_POST['forname'];
            $lname = $_POST['lastname'];
            $adress = $_POST['adress'];
            $telefon = $_POST['telefon'];
            $email = $_POST['email'];
        
    try 
    {
    require_once("../../includes/test.php");
        
        
    $query = "UPDATE project ";
    $query .=  "SET fname = :fname, lname = :lname, adress = :adress, telefon = :telefon, email = :email ";
    $query .= "WHERE id = :id";
    
    $ps = $db->prepare($query);
    $result = $ps->execute(array('fname'=>$fname,'lname'=>$lname,'adress'=>$adress,'telefon'=>$telefon,'email'=>$email,'id'=>$_SESSION['id']));
    
    
    if($result)
    {
        //header("Location: Profil.php");
    }
    else
    {
        echo "Update up failed";
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
        $query .= "WHERE id = :id";
        
        $ps = $db->prepare($query);
        $result = $ps->execute(array('id'=>$_SESSION['id']));
        $user = $ps->fetch(PDO::FETCH_ASSOC);
        /*$user = $ps->fetchAll();*/
    }
   catch(Exception $exception)
    {
        echo "Epic fail: <br /><br />";
        echo $exception."<br /><br />";
    }
    
    include('../layout/Header.php');
?>
<div class="container">    
    <ul class="nav nav-pills nav-justified">
        <li role="presentation"><a href="Home.php">Hem</a></li>
        <li class="dropdown active" role="presentation"><a href="About.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Om <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Profil.php">Profil</a></li>
            <li><a href="Klass.php">Klass</a></li>
            <li><a href="Betyg.php">Betyg</a></li>
            <li><a href="Schema.php">Schema</a></li>
            <li><a href="Kursplan.php">Kurs plan</a></li>
          </ul>
        </li>
        <li role="presentation"><a href="../kontakt/Contact.php">Kontakt</a></li>
        <li role="presentation"><a href="../layout/logout.php">Logga ut</a></li>
    </ul>
    <div class="jumbotron">
    <h3>Profil</h3>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Min Profil
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
        <div class="row">
        <div class="col-md-6">
            <table class="table table-hover">
            <?php
			echo "<tr>";
			echo "<td>". $user['fname'] . "</td></tr><tr><td>" . $user['lname'] . "</td></tr><tr><td>" . $user['adress'] . "</td></tr><tr><td>". $user['telefon'] ."</td></tr><tr><td>". $user['email'] ."</td>";
			echo "</tr>";
            ?>
            </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Ändra Profil
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
    <form class="form-horizontal col-md-4 col-md-offset-5" role="form" action="Profil.php" method="post">
        <div class="form-group">
            <input type="text" class="form-controll" id="forname" name="forname" value="<?php echo $_SESSION['forname'];?>" placeholder="Förnamn">
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname'];?>" placeholder="Efternamn">
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="adress" name="adress" value="<?php echo $_SESSION['adress'];?>" placeholder="Address">
        </div>
        <div class="form-group">
            <input type="text" class="form-controll" id="telefon" name="telefon" value="<?php echo $_SESSION['telefon'];?>" placeholder="Telefon">
        </div>
        <div class="form-group">
            <input type="email" class="form-controll" id="email" name="email" value="<?php echo $_SESSION['email'];?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" id="myButton" name="submit" value="Submit">
        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    <?php if($_SESSION['profession']==2):?> 
        <div class="form-group col-md-4 col-md-offset-5">
            <button type="button" class="btn btn-default"><a href="../layout/sigup.php">Till Sign up</a></button>
        </div>
    <?php endif; ?>
    </div>
</div>

