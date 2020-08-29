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
                            <li><a class="is-active" href="../contact">CONTACT US</a></li>
                        </ul>
                    </div>
                    <div id="menuBurger" onclick="openMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>
        </header>

        <div class="wrapper">
            <div class="columns">
                <section class="column is-two-thirds contact-form">
                    <div class="container">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
                            <h3 class=" title is-2 has-text-white">Reach out to us!</h3>
                            <p class="subtitle is-6 has-text-white">Fill out the form and our team will get back to you the
                                soonest.</p>
                            <?php if($msgText != ''): ?>
                            <div class="notification <?php echo $msgType; ?> is-light has-text-centered">
                                <?php echo $msgText; ?>
                            </div>
                            <?php endif; ?>
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
                            <button class="btn hover-btn button send has-text-primary has-text-weight-bold" name="submit"
                                type="submit" <?php echo $disableForm; ?>>Submit</button>
                        </form>
                    </div>
                </section>

                <section class="column email-adds">
                    <div class="container has-text-white">
                        <h2 class="title is-2 has-text-white mb-1">Contact Information</h2>
                        <ul>
                            <li><a class="emails" target="_blank"
                                    href="mailto:&#97;&#100;&#109;&#105;&#110;&#64;&#118;&#99;&#103;&#109;&#99;&#104;&#117;&#114;&#99;&#104;&#46;&#111;&#114;&#103;"><i
                                        class="fas fa-question-circle"></i> Admin</a>
                            </li>
                            <li><a class="emails" target="_blank"
                                    href="mailto:&#118;&#105;&#115;&#105;&#111;&#110;&#99;&#111;&#108;&#108;&#101;&#103;&#101;&#64;&#118;&#99;&#103;&#109;&#99;&#104;&#117;&#114;&#99;&#104;&#46;&#111;&#114;&#103;"><i
                                        class="fas fa-university"></i> Vision
                                    Leadership College</a>
                            </li>
                        </ul>

                        <h2 class="title is-2 has-text-white follow mb-1">Follow Us</h2>
                        <ul class="follow-socials">
                            <li><a href="https://www.instagram.com/vcgmchurch/" target="_blank"><i
                                        class="fab fa-instagram"></i></a>
                            </li>
                            <li><a href="https://www.youtube.com/channel/UCdEjO9AOccUIS_IMNirLtMg/videos" target="_blank"><i
                                        class="fab fa-youtube"></i></a>
                            </li>
                            <li><a href="https://www.facebook.com/vcgmofficial/" target="_blank"><i
                                        class="fab fa-facebook"></i></a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>