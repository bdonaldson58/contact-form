<?php

#   Message variables
    $msg = '';
    $msgClass = '';


/*  
    If the form has been submitted...
        filter_has_var - checking to see if variable of specified type exists
        INPUT_POST -  indicates that we are submitting a post form
*/      if(filter_has_var(INPUT_POST, 'submit')){ 


/*      Getting the data from the form using POST 
        Each variable in apostrophes, i.e. 'email', refers to the name in the html form
        htmlspecialchars converts special characters into html entities so people cannot
        run scripts or harmful code in your form.
*/
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $phone = htmlspecialchars($_POST['phone']);
    

/*      Checking required fields
            If the email, name and message fields are all NOT empty, then the form passed.
            Else, the user input failed, and messages will display according to which
            field failed the test
*/      if(!empty($email) && !empty($firstname) && !empty($lastname) && !empty($phone) && !empty($message)){


/*        The form has been submitted and the fields are not empty
          Now validating email. Using FILTER_VALIDATE_EMAIL inside of
          filter_var in order to validate that a correct email address has
          been entered.
*/        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $msg = 'Please enter a valid email address';
            $msgClass = 'alert-danger';   
          } else {
              #Sending the email
                $toEmail = 'bdonaldson58@gmail.com';
                $subject = 'Contact Request From '.$name;
                $body = '<h2>Contact Request</h2>
                        <h4>First Name</h4><p> '.$firstname.'</p>
                        <h4>Last Name</h4><p> '.$lastname.'</p>
                        <h4>Phone Number</h4><p> '.$phone.'</p>
                        <h4>Email</h4><p> '.$email.'</p>
                        <h4>Message</h4><p> '.$message.'</p>
                        ';
                #Setting Email Headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "
                    \r\n";

                # Additional Headers
                $headers .= "From: " .$firstname. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
                # Email sent
                    $msg = 'Your email has been sent';
                    $msgClass = 'alert-success';
                } else {
                    # Email sent
                    $msg = 'Your email was not sent';
                    $msgClass = 'alert-danger';
                }    
            }
        } else {
            //Failed
            $msg = 'Please fill in all fields';
            $msgclass = 'alert-danger';
        }      
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
    href="https://bootswatch.com/cosmo/bootstrap.min.css">
    <title>Contact Us</title>
</head>
<body>  
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">My Website</a>>
        </div>
      </div>
    </nav>
    <div class="container">
    <!-- If $msg is not blank, ouput $msg and $msgClass variables   -->
        <?php if($msg != ''): ?> 
            <div class="alert <?php echo $msgClass; ?>">
            <?php echo $msg; ?></div>

        <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; # Submitting to this file ?>">

<!--    php echo isset on each input makes sure that if the form fails and the user has entered
        information to the form, the information will still be in the form -->
            <div class="form-group"> 
                <label>First Name</label> 
                <input type="text" name="firstname" class="form-control" 
                value="<?php echo isset($_POST['firstname']) ? $firstname : ''; ?>"> 
            </div>
            <div class="form-group"> 
                <label>Last Name</label> 
                <input type="text" name="lastname" class="form-control" 
                value="<?php echo isset($_POST['lastname']) ? $lastname : ''; ?>"> 
            </div>
            <div class="form-group"> 
                <label>Phone</label> 
                <input type="text" name="phone" class="form-control" 
                value="<?php echo isset($_POST['phone']) ? $phone : ''; ?>"> 
            </div>
            <div class="form-group"> 
                <label>Email</label> 
                <input type="text" name="email" class="form-control" 
                value="<?php echo isset($_POST['email']) ? $email : ''; ?>"> 
            </div>         
            <div class="form-group"> 
                <label>Message</label> 
                <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea> 
            </div><br> 
            <button type="submit" name="submit" class="btn btn-primary"> Submit</button> 


        </form>      
    </div>


</body>
</html>