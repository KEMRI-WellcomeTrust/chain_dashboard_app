<?php  
 // Initial setup for sending mail  
 ini_set("SMTP","172.16.14.14"); // outgoing mail server address  
 ini_set("smtp_port",25); // smtp port no. It may be different than 25 if you are using ssl  
 ini_set("sendmail_from","nngao@kemri-wellcome.org");   
 $to = "caesar.olima@gmail.com";  
 $subject = "Test mail";  
 $message="&amp;lt;html&amp;gt;&amp;lt;body&amp;gt;hello hello&amp;lt;/body&amp;gt;&amp;lt;/html&amp;gt;"; // your html mail body  
 $from = " From email address";  
 $headers = "From: ".$from."rn";  
 $headers .= "Content-type: text/htmlrn"; // to send html formatted mail  
// mail($to,$subject,$message,$headers);  
   
mail('nngao@kemri-wellcome.org','Test','tester');

mail('narshon@gmail.com','Test','tester');
echo "Mail Sent.";
 ?>
