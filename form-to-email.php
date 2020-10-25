<?php


  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "harnoor24.21@gmail.com";
  $mail->Password   = "LuciFer@!Helion";



if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n \n \n \n \n $message \n \n \r Email ID : $visitor_email".

        $mail->IsHTML(true);
        $mail->From="harnoor24.21@gmail.com";
        $mail->FromName="Form Submission by $name";
        $mail->AddReplyTo($visitor_email, $name);
        $mail->Subject = $subject;
        $mail->Body = $email_body;
        $mail->AddAddress('harnoor24@outlook.com');
        if(!$mail->Send())
        {
            $error ="Please try Later, Error Occured while Processing...";
            return $error; 
        }
        else 
        {
          
              header('Location: thankyou.html');
           
        }
    
    

    
    
    $error=smtpmailer($to,$from, $name ,$subject, $email_body);




// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 