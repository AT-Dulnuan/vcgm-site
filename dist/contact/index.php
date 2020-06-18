<?php
    $msgText = '';
    $msgType = '';
    $emailError = '';
    $disableForm = '';

    if(filter_has_var(INPUT_POST, 'submit')) {

        $fullName = htmlspecialchars($_POST['fullName']);
		$email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        

        if(!empty($fullName) && !empty($email) && !empty($message) ) {

            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){

                $msgText = 'Please enter a valid email address.';
                $msgType = 'is-danger';
                $emailError = 'is-danger';

            } else {

                $toEmail = 'support@vcgmchurch.org';
                $subject = 'Contact Request From '.$fullName;
                $body = '<h2>Contact Form</h2>
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
    <title>VCGM | Contact Us</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">

    <!-- Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bulma-main.css">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <div class="main-wrapper" id="contact">
        <header>
            <nav data-aos="fade" data-aos-duration="500">
                <div class="content-wrapper">
                    <a href="../" class="logo"><img src="../assets/logo.png" alt=""></a>
                    <div class="nav-links">
                        <ul>
                            <li><a href="../">HOME</a></li>
                            <li><a href="../about">ABOUT</a></li>
                            <li><a href="../locations">LOCATIONS</a></li>
                            <li><a href="../sermons">SERMONS</a></li>
                        </ul>
                        <div class="btn-container">
                            <a href="./" class="btn btn-outline hover-btn" id="connect-btn">Lets
                                Connect</a>
                        </div>
                    </div>
                    <div id="menuBurger" onclick="openMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>

            <div class="header-text">
                <h1 data-aos="fade-down" data-aos-duration="1000">Contact Us</h1>
            </div>
        </header>

        <section class="contact-form">
            <div class="container">
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
                        <label class="label">Email</label>
                        <div class="control has-icons-left">
                            <input class="input <?php echo $emailError; ?>" type="email" name="email"
                                placeholder="john.doe@mail.com"
                                value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" name="message"
                                placeholder="Type your message here..."><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                        </div>
                    </div>
                    <button class="button send has-text-white" name="submit" type="submit"
                        <?php echo $disableForm; ?>>Submit</button>
                </form>
            </div>
        </section>

        <footer>
            <div class="row">
                <div class="brand">
                    <img src="" alt="">
                    <p>We are a Pentecostal movement whose heart is in building up transformed and empowered communities
                        of faith with a desire to live out God’s Word and reflect His service and ministry so we can
                        influence the world.</p>
                </div>
                <div class="links">
                    <ul>
                        <li><a href="../">HOME</a></li>
                        <li><a href="../about">ABOUT</a></li>
                        <li><a href="../locations">LOCATIONS</a></li>
                        <li><a href="../sermons">SERMONS</a></li>
                    </ul>
                </div>
                <div class="connect">
                    <p>Lets Connect!</p>
                    <ul>
                        <a href="https://www.instagram.com/vcgmchurch/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCdEjO9AOccUIS_IMNirLtMg/videos"><i
                                class="fab fa-youtube"></i></a>
                        <a href="https://soundcloud.com/vcgm-perth"><i class="fab fa-soundcloud"></i></a>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>