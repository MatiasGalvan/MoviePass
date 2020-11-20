<?php

    namespace Utils;

    use Endroid\QrCode\QrCode;
    use PHPMailer\PHPMailer as PHPMailer;
    use PHPMailer\Exception as Exception;
    use PHPMailer\SMTP as SMTP;

    class Utils{

        public static function ValidateAdmin(){
            $flag = false;
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') $flag = true;
            return $flag;
        }

        public static function ValidateUser(){
            $flag = false;
            if(isset($_SESSION['email']) && !empty($_SESSION['email'])) $flag = true;
            return $flag;
        }

        public static function checkEmail($value){
            $response = false;
            if(filter_var($value, FILTER_VALIDATE_EMAIL)){
                $response = true;
            }
            return $response;
        }
    
        public static function checkString($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,})$/";
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }
    
        public static function checkDNI($value){
            $regularDNI = "/^[0-9]{8}$/";
            $response = false;
            if (preg_match($regularDNI, $value)){
                $response = true;
            }
            return $response; 
        }
    
        public static function checkPassword($value){
            /*
            Minimo 8 caracteres
            Maximo 15
            Al menos una letra mayúscula
            Al menos una letra minucula
            Al menos un dígito
            No espacios en blanco
            */
            $regularPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)([A-Za-z\d]|[^ ]){8,15}$/";
            $response = false;
            if (preg_match($regularPass, $value)){
                $response = true;
            }
            return $response; 
        }

        public static function checkDate($date){
            $response = true;
            $time = time();
            $currentDate = date("Y-m-d", $time);
            
            if($date < $currentDate) $response = false;

            return $response;
        }

        public static function checkTime($time){
            $response = true;
            $currentTime = date("H:i", time());

            if($time < $currentTime) $response = false;

            return $response;
        }

        public static function checkNumber($value){
            $regularNumber = "/(^[0-9]{1,4}$)/";
            $response = false;
            if (preg_match($regularNumber, $value) && $value > 0){
                $response = true;
            }
            return $response; 
        }

        public static function checkAddress($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,} \d{1,5})$/";
            
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }
        
        public static function AddMinutes($time, $minutes){ 
            $secondsTime = strtotime($time);
            $seconds = $minutes * 60;
            $newTime = date("H:i:s", $secondsTime + $seconds);
            return $newTime;
        }

        public static function GenerateQR($id, $url, $movie){
            $qrCode = new QrCode($url);
            $qrCode->setSize(250);
            $qrCode->setLabel($movie);
            $qrCode->writeFile("Data/temp/" . $id . ".png");
        }
        
        public static function SendEmail($email){
            try {
                //Server settings
                $mail = new  PHPMailer();
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';           //PARA GMAIL         // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'moviepass154@gmail.com';                     // SMTP username
                $mail->Password   = '1234moviepass';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('moviepass154@gmail.com', 'MoviePass'); //DESDE DONDE SE MANDA EL MAIL
                $mail->addAddress($email);   //DESTINATARIO // Name is optional
            
            
                // Attachments //Enviar archivos o imagenes
                $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Prueba de moviePass';
                $mail->Body    = 'Probando envio de correo con PHPMailer</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    }

?>