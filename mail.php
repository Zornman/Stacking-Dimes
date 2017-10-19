<?php
$name = "";
$nameError = "";
$email = "";
$emailError = "";
$subject = "";
$subjectError = "";
$message = "";
$messageError = "";

if(isset($_POST['submit'])) {
    if (empty($_POST["name"])){
        $nameError = "Name is required";
    }
    else
    {
        $name = test_input($_POST["name"]); // check name only contains letters and whitespace

        if (!preg_match("/^[a-zA-Z ]*$/",$name)){
            $nameError = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])){
        $emailError = "Email is required";
    }
    else
    {
        $email = test_input($_POST["email"]);
    } // Checking null values in message.

    if (empty($_POST["subject"]))
    {
        $subjectError = "Subject is required";
    }
    else
    {
        $subject = test_input($_POST["subject"]);
    } // Checking null values in message.

    if (empty($_POST["message"]))
    {
        $messageError = "Message is required";
    }
    else
    {
        $message = test_input($_POST["message"]);
    } // Checking null values in the message.

    if( !($name=='') && !($email=='') && !($subject=='') &&!($message=='') ){ // Checking valid email.
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
            $header= $name."<". $email .">";
            $headers = "StackingDimes.com"; /* Let's prepare the message for the e-mail */

            $msg = "Hello! $name Thank you for contacting us.
            Name: $name
            E-mail: $email
            Subject: $subject
            Message: $message
            This is a Contact Confirmation mail. We Will contact You as soon as possible.";

            $msg1 = " $name Contacted Us. Here is some information about $name.
            Name: $name
            E-mail: $email
            Subject: $subject
            Message: $message "; /* Send the message using mail() function */

            if(mail($email, $headers, $msg ) && mail("Stackingdimes16@gmail.com", $header, $msg1 )){
                $successMessage = "Message sent successfully.......";
            }
        }
        else {
            $emailError = "Invalid Email";
        }
    }
}
 // Function for filtering input values.function test_input($data)
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>