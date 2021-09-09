<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once 'vendor/autoload.php';

    class Mails{

        public function envioEmail(){
                $mail = new PHPMailer(true);
                if (session_status() === PHP_SESSION_NONE) :
                    session_start();
                endif;

                if(!isset($_SESSION['empresa'])) :
                        header("Location:index.php");
                endif;

            try {
                //Server settings
                //$mail->SMTPDebug = 2;                      //Enable verbose debug output

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'markiewiczdiego@gmail.com';                     //SMTP username
                $mail->Password   = 'Die*666666';                               //SMTP password
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->SMTPSecure = 'TLS';
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('markiewiczdiego@gmail.com', 'Soy yo!');
                $mail->addAddress('dieghard@gmail.com', 'Soy yo!');     //Add a recipient
                $mail->addReplyTo('francoaguado@gmail.com', 'Franco Aguado');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
            //   $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'ESTA ES UNA PRUEBA DE MAIL';
                $mail->Body    = '<smal>puto... </smal> <b>EL QUE LEE</b>';
                $mail->AltBody = 'puto el que lee...';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
