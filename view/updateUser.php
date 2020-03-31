<?php

require('../common/header.php');?>



<main>
        <h1><?php if(isset($clientData['clientFirstname'])){ echo "Modify $clientData[clientFirstname] $clientData[clientLastname] ";} elseif(isset($clientFirstname)) { echo $cleintFirstname; }?></h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form method="post" action="./accounts/index.php" id="registrationform">
                
                    <div>
                        <input class="requiredinvalid" id="clientFirstname" name="clientFirstname"
                        type="text" required <?php if(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; } ?> >
                        <label for="clientFirstname">First Name</label>
                    </div>
                    <div>
                        <input class="requiredinvalid" id="clientLastname" name="clientLastname"
                        type="text" required <?php if(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; } ?> >
                        <label for="clientLastname">Last Name</label>
                    </div>
                    <div>
                        <input class="requiredinvalid" id="clientEmail" name="clientEmail"
                        type="email" required 
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" tabindex="3" 
                        <?php if(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'";  } ?>>
                        <label for="clientEmail">e-Mail Address</label>
                    </div>
                    
                

                <input type="submit" name="submit" value="Update Info">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateUser">
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
                
                
            </form>


            <hr><hr>


            <h1><?php if(isset($clientData['clientFirstname'])){ echo "Modify $clientData[clientFirstname] $clientData[clientLastname] Password ";} elseif(isset($clientFirstname)) { echo $cleintFirstname; }?></h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form method="post" action="./accounts/index.php">
            
                    <div>
                        <input class="requiredinvalid" id="clientPassword" name="clientPassword"
                        type="password" required <?php if(isset($clientData['clientPassword'])) {echo "value='$clientData[clientPassword]'"; } ?>
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character."/>
                        <label for="clientPassword">Password</label>
                    </div>
               

                <input type="submit" name="submit" value="Update Password">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
                
            </form>
        </main>
         <?php
    require('../common/footer.php'); 
    ?>