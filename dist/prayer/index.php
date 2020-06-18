<?php
    $msgText = '';
    $msgType = '';
    $emailError = '';
    $disableForm = '';

    if(filter_has_var(INPUT_POST, 'submit')) {

        $fullName = htmlspecialchars($_POST['fullName']);
        $phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $prayerMethod = htmlspecialchars($_POST['prayerMethod']);
        $connect = htmlspecialchars($_POST['connect']);
        

        if(!empty($fullName) && !empty($email) && !empty($phone) && !empty($message) ) {

            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){

                $msgText = 'Please enter a valid email address.';
                $msgType = 'is-danger';
                $emailError = 'is-danger';

            } elseif ( !preg_match("/^[0-9]{2,}+-[0-9]{3}+-[0-9]{4}$/", $phone)) {
                $msgText = 'Please enter a valid phone number.';
                $msgType = 'is-danger';
                $emailError = 'is-danger';

            } else {

                $toEmail = 'prayer@vcgmchurch.org';
                $subject = 'Prayer Request From '.$fullName;
                $body = '<h2>Prayer Form</h2>
                        <h4>'.$prayerMethod.'</h4>
                        <h4>'.$connect.'</h4>
                        <p><strong>Name: </strong>'.$fullName.'</p>
                        <p><strong>Contact Number: </strong>'.$phone.'</p>
                        <p><strong>Email: </strong>'.$email.'</p>
                        <p><strong>Prayer Request: </strong>'.$message.'</p>';

                $headers = "MIME-Version: 1.0" ."\r\n";
                $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                
                $headers .= "From: " .$fullName. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
					
					$msgText = 'Your prayer request has been sent!';
                    $msgType = 'is-success';
                    $disableForm = 'disabled';

				} else {
					
					$msgText = 'Unfortunately, your prayer request was not sent. Please try again in a while.';
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
    <link rel="stylesheet" href="../css/bulma-main.css">
</head>

<body>

    <div class="main-wrapper" id="prayer">
        <div class="level is-mobile">
            <div class="container">
                <h2 class="title is-2 has-text-white has-text-centered">Prayer Request</h2>
                <p class="verse is-italic has-text-centered has-text-white">"Let us approach God's throne of grace with
                    confidence, so that
                    we may receive mercy and find grace to help us in our time of need." <br> Hebrews 4:16</p>
                <?php if($msgText != ''): ?>
                <div class="notification <?php echo $msgType; ?> is-light has-text-centered">
                    <?php echo $msgText; ?>
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
                            <input class="input" type="tel" pattern="[0-9]{2,}+-[0-9]{3}+-[0-9]{4}" name="phone"
                                placeholder="0999-123-4567" value="<?php echo isset($_POST['phone']) ? $phone : ''; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left">
                            <input class="input" type="email" name="email" placeholder="john.doe@mail.com"
                                value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
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
                    <div class="field has-text-white">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="prayerMethod" value="For personal prayer only" checked> For
                                personal prayer only</label>
                        </div>
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="prayerMethod" value="Can be shared to prayer groups"> Can be
                                shared
                                to prayer groups</label>
                        </div>
                    </div>
                    <div class="field has-text-white">
                        <label class="label">Would you want our prayer team to get in touch with you?</label>
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="connect" value="Would like to get in touch" checked>
                                Yes</label>
                            <label class="radio">
                                <input type="radio" name="connect" value="Would prefer not to get in touch">
                                No</label>
                        </div>
                    </div>
                    <button class="button is-primary" name="submit" type="submit"
                        <?php echo $disableForm; ?>>Send</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>