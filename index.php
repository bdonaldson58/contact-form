<?php require('inc/contact.php');?>
<?php include('inc/header.php');?>
    <div class="container">
    <!-- If $msg is not blank, ouput $msg and $msgClass variables   -->
        <?php if($msg != ''): ?> 
            <div class="alert <?php echo $msgClass; ?>">
            <?php echo $msg; ?></div>

        <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; # Submitting to this file ?>">

<!--    php echo isset on each input makes sure that if the form fails and the user has entered
        information to the form, the information will still be in the form -->
            <h3>Contact Form</h3> 
            <h4>Please fill out the information below, click submit, and we will respond 
            to you as soon as possible.</h4>
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