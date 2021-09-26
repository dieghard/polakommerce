<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   require_once 'vendor/autoload.php';
    class Mails{

        public function envioEmail(){
            require_once("Class/empresa.php");
            $empresa = new Empresa();
            $empresa = $empresa->Empresa();

                $superArray = array();
                $superArray['envioMail'] = false;
                $mail = new PHPMailer(true);
                if (session_status() === PHP_SESSION_NONE) :
                    session_start();
                endif;

                if(!isset($_SESSION['pedido'])) :
                        header("Location:index.php");
                endif;

                if(!isset($_SESSION['cliente'])) :
                    header("Location:index.php");
                endif;
            try {
                //Server settings
                //$mail->SMTPDebug = 2;                      //Enable verbose debug output

                if ($empresa->getEmail_is_smtp()) :
                    $mail->isSMTP();
                endif;           //Enable SMTP authentication
                $mail->Host       =  $empresa->getEmail_Host() ;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = false;
                if ($empresa->getEmail_smtp_auth()) :
                    $mail->SMTPAuth   = true;
                endif;           //Enable SMTP authentication

                $mail->Username   = $empresa->getEmail_username();                     //SMTP username
                $mail->Password   = $empresa->getEmail_password(); //SMTP password
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->SMTPSecure = $empresa->getEmail_smtpSecure();
                $mail->Port       = $empresa->getEmail_port();//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($empresa->getEmail_username(), $empresa->getDescripcion());
                $mail->addAddress($_SESSION['cliente']['email'], $_SESSION['cliente']['nombre'] . ' ' . $_SESSION['cliente']['apellido']);     //Add a recipient
                $mail->addReplyTo( $empresa->getEmail_username(), $empresa->getDescripcion() );

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Hola!,' .$_SESSION['cliente']['nombre'] ;
                $mail->Body    = '<b>Gracias por su compra!</b>  el pedido con el numero:' . $_SESSION['pedido']['numeroPedido'] . ' a sido realizado correctamente </br> depacharemos el pedido a la brevedad y le estaremos avisando por este medio' ;
                $mail->AltBody = 'Gracias por su compra!depacharemos el pedido a la brevedad y le estaremos avisando por este medio';
                $mail->send();
                $superArray['envioMail'] = true;
                return $superArray;
            } catch (Exception $e) {
                $superArray['mensaje'] = "El mensaje no pudo ser enviado. Error de mail: {$mail->ErrorInfo}";
                return $superArray;
            }
        }
    }
