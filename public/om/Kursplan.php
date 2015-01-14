<?php
session_start();


if( isset($_POST['upload']) ){
		
		echo "<pre>";
		
		echo "</pre>";
		
		
		  if( is_uploaded_file($_FILES['upfile']['tmp_name']) ){
                
		
                $fileName = $_FILES['upfile']['name'];           		         		           
                $fileTempName = $_FILES['upfile']['tmp_name'];					     
				$fileSize =  $_FILES['upfile']['size']; 						
                $path = "../uploads/";												
                $newPathAndName = $path . $fileName;		
                if( move_uploaded_file($fileTempName, $newPathAndName)  ){
                    echo "The file has been successfully uploaded<br /><br />";
					
                } else {
                    echo "Could not upload the file";
                }
				
            }
        
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
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Mina kurser
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">      
        <div class="panel-body">
      <?php
            $directory = scandir ('../upload');
            for($i = 0; $i < sizeof($directory); $i++){
            $xplode = explode("_", $directory[$i]);
            if($_SESSION['class_id'] == 1 && ($xplode[0] === "WUK14") && ($xplode[1] === "Kursplanering.pdf"))
            {
                echo "<a href='../upload/$directory[$i]' target=\"_blank\"> Visa </a>";
                
            }
            if($_SESSION['class_id'] == 2 && ($xplode[0] === "PTK14") && ($xplode[1] === "Kursplanering.pdf"))
            {
                echo "<a href='../upload/$directory[$i]' target=\"_blank\"> Visa </a>";
            }
            if($_SESSION['class_id'] == 3 && ($xplode[0] === "COB14") && ($xplode[1] === "Kursplanering.pdf"))
            {
                echo "<a href='../upload/$directory[$i]' target=\"_blank\"> Visa </a>";
            }
            if($_SESSION['class_id'] == 4 && ($xplode[0] === "PRL14") && ($xplode[1] === "Kursplanering.pdf"))
            {
                echo "<a href='../upload/$directory[$i]' target=\"_blank\"> Visa </a>";
            }
            }
        ?>
        </div>
    </div>
    </div>
<?php if($_SESSION['profession']==2 || $_SESSION['profession']==1):?>
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Sätt upp/Ändra Kurser
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      <form action="Schema.php" method="POST" enctype="multipart/form-data">
        file: <input type="file" name="upfile" value=""/><br />
        <input type="submit" name="upload" value="upload"/>
      </form>
      </div>
    </div>
  </div>
<?php endif; ?>
</div>
</div>
</div>