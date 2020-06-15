<?php
    $msgText = '';
    $msgType = '';
    $emailError = '';
    $disableForm = '';

    if(filter_has_var(INPUT_POST, 'submit')) {

        $fullName = htmlspecialchars($_POST['fullName']);
		$email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $prayerMethod = htmlspecialchars($_POST['prayerMethod']);
        

        if(!empty($fullName) && !empty($email) && !empty($message) ) {

            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){

                $msgText = 'Please enter a valid email address.';
                $msgType = 'is-danger';
                $emailError = 'is-danger';

            } else {

                $toEmail = 'prayer@vcgmchurch.org';
                $subject = 'Prayer Request From '.$fullName;
                $body = '<h2>Prayer Form</h2>
                        <p><strong>'.$prayerMethod.'</strong></p>
                        <p><strong>Name: </strong>'.$fullName.'</p>
                        <p><strong>Email: </strong>'.$email.'</p>
                        <p><strong>Message: </strong>'.$message.'</p>';

                $headers = "MIME-Version: 1.0" ."\r\n";
                $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                
                $headers .= "From: " .$fullName. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
					
					$msgText = 'Your email has been sent successfully! We will get back to you shortly.';
                    $msgType = 'is-success';
                    $disableForm = 'disabled';

				} else {
					
					$msgText = 'Unfortunately, your email was not sent. Please try again in a while.';
                    $msgType = 'is-danger';
                    
				}
            }
        } else {

            $msgText = 'Please fill in all the fields.';
            $msgType = 'is-danger';

        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCGM | Prayer Request</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">

    <!-- Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <div class="main-wrapper level" id="prayer">
        <div class="container has-text-white">
            <h2 class="has-text-centered">Prayer Request</h2>
            <?php if($msgText != ''): ?>
            <div class="notification <?php echo $msgType; ?> is-light has-text-centered">
                <?php echo $msgText; ?>
                <?php if($msgType == 'is-success') : ?>
                <div class="container has-text-centered">
                    <a href="../" class="button is-text return-btn">Return to Home</a>
                </div>
                <?php endif;?>
            </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
                <div class="field">
                    <label class="label">Full Name</label>
                    <div class="control has-icons-left">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <input class="input" type="text" name="fullName" placeholder="John Doe"
                            value="<?php echo isset($_POST['fullName']) ? $fullName : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Contact Number</label>
                    <div class="control has-icons-left">
                        <input class="input <?php echo $emailError; ?>" type="email" name="email"
                            placeholder="09991234567" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                        <span class="icon is-small is-left">
                            <i class="fas fa-phone"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input class="input <?php echo $emailError; ?>" type="email" name="email"
                            placeholder="john.doe@mail.com" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Prayer Request</label>
                    <div class="control">
                        <textarea class="textarea" name="message"
                            placeholder="Type your message here..."><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="prayerMethod" value="For personal prayer only" checked> For
                            personal prayer only</label>
                        <label class="radio">
                            <input type="radio" name="prayerMethod" value="Can be shared to prayer groups"> Can be shared
                            to prayer groups</label>
                    </div>
                </div>
                <button class="button send has-text-white" name="submit" type="submit"
                    <?php echo $disableForm; ?>>Send</button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>