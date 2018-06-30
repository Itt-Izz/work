<?php include ('php/query.php');?>
  <nav class="navbar navbar-default">
  <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="index.php">LasitTeaCompany</a>
      </div>
      <div id="navR">
          <ul class="nav navbar-nav navbar-right">    
            <?php 
            if(isset($_SESSION['username'])){ ?>      
            <li> <a href="account.php" id="nam2" > Hi <span id="nam"><?php echo $_SESSION['username']; ?></span></a></li>
          <li><a href="message.php" id="mes"> New Messages: 
           <?php           
              if ($row = $mesNo->fetch_array()) {
                if($row['count(*)']>0){ ?>
                  <span class="badge"><?php echo $row['count(*)']; ?></span>
            <?php }else
             echo "0"; }    ?>
           </a> </li>   
           <li> 
                <div class="dropdown">
                   <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
                              <div class="imgPos">
                                <?php $row = $img->fetch_assoc();  
                           echo "<img src='empImgs/".$row['image']."'class='img-circle' id='hdimg'>";?>
                            <span class="caret"></span>
                             </div>
                   </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="contact.php" id="conn">My Contact</a></li>
                                                <li><a href="account.php" id="accc">My Account</a></li>
          <li><a href="php/logout.php" >Logout <span  id="lg" class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>   
                                                
                                            </ul>
                                        </div>
              </li>

    <?php } ?>
              
        </ul>
      </div>
  </div>
  </nav>