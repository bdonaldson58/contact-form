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
                $subject = 'Contact Request From '.$firstname;
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