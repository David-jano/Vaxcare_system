<?php

    $email = $_POST['email']; // this is the email address of the person filling the contact form
    $name = $_POST['name']; // name of the sender
    $whom = $_POST['whom']; // email address where the contact form data will be sent
    $subject = "Email from Contact form";

    $comment = $name . " " . $email . " wrote the following:" . "\n\n" . $_POST['comment'];

    mail($whom,$subject,$comment); // this is the email function

    echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";

?>