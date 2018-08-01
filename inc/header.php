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
      </div>   
        <ul class="nav navbar-nav">
          <li><a class="navbar-brand" href="home.php" id="lasitStyl" >LasitTeaCompany</a>
          </li>
          <li><a href="home.php"> <img src="img/logo.png" id="hdimg2"></a></li>
        </ul>
          <ul class="nav navbar-nav navbar-right"> 
            <?php 
            if(isset($_SESSION['username'])){ ?>      
            <li> <a href="account.php" id="nam2" > Hi <span id="nam"><?php echo $_SESSION['username']; ?></span></a></li>
            <?php if($_SESSION['level']!=='staff'){?>
          <li><div style="margin-top: 5px;"><a href="message.php"><img src='img/notification.png' class="img-circle" id='hd'> 
           <?php           
              if ($row = $mesNo->fetch_array()) {
                if($row['count(*)']>0){ ?>
                  <span class="notify-badge"><?php echo $row['count(*)']; ?></span>
            <?php }else
             echo "0"; }    ?>
           </a>            
          </div></li>  
          <?php } ?> 
           <li> 
                <div class="dropdown">
                   <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
                              <div class="imgPos">
                                <?php $row = $img->fetch_assoc(); 
                                if ($row['image']=='') { ?>
                                  <img src="img/ava.png" class="img-circle hdimg">
                               <?php  } else{
                                  echo "<img src='empImgs/".$row['image']."'class='img-circle hdimg'>";
                                 }
                           ?>
                            <span class="caret"></span>
                             </div>
                   </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="account.php" id="accc">My Profile</a></li>
                                         <?php if($_SESSION['level']=='admin'){?>                                                   
                                                <li><a href="sms.php" id="accc">Send SMs</a></li>
                                                <?php } ?>
                                                <li><a href="settings.php" id="conn">Settings</a></li>
          <li><a href="php/logout.php" >Logout <span  id="lg" class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>          
                                            </ul>
                                        </div>
              </li>

    <?php } ?>
              
        </ul>
  </div>
  </nav>