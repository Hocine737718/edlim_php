<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    include 'includes/init.php';
    if(isset($_POST['quote'])&& isset($_FILES['attachment_file']) && $_FILES['attachment_file']['error'] === UPLOAD_ERR_OK){
        $decodedData = json_decode($_POST['quote'], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $name = htmlspecialchars($decodedData['name'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($decodedData['email'], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($decodedData['phone'], ENT_QUOTES, 'UTF-8');
            $job = htmlspecialchars($decodedData['job'], ENT_QUOTES, 'UTF-8');
            $entreprise = htmlspecialchars($decodedData['entreprise'], ENT_QUOTES, 'UTF-8');
            $object = htmlspecialchars($decodedData['object'], ENT_QUOTES, 'UTF-8');
            $message = htmlspecialchars($decodedData['message'], ENT_QUOTES, 'UTF-8');
            
            // Load Composer's autoloader
            require 'includes/mailer/autoload.php';
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try{
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                       Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'salimlyes2024@gmail.com';                     // SMTP username
                $mail->Password   = 'twix rupv msnk ttsy';
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                // Content
                $mail->isHTML(true);  
                $mail->CharSet = "UTF-8";
                $mail->setFrom('salimlyes2024@gmail.com', 'GMS Mail');
                $mail->addAddress('salimlyes2024@gmail.com');//le recepeteur
                $mail->Subject = 'Devis-'.$object;//sujet
                $cssContent = file_get_contents('includes/css/mail.css'); 
                $html='
                <html>
                    <head>
                        <style>
                            '.$cssContent.'
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h2>Nom : '.$name.'</h2>
                            <h2>Email : '.$email.'</h2>
                            <h2>Téléphone : '.$phone.'</h2>
                            <h2>Entreprise : '.$entreprise.'</h2>
                            <h2>Fonction : '.$job.'</h2>
                            <p>
                                '.$message.'
                            </p>
                        </div>
                    </body>
                </html>
                ';  
                $mail->Body= $html;   
                $file_tmp_path = $_FILES['attachment_file']['tmp_name'];
                if (file_exists($file_tmp_path)) {
                    $mail->addAttachment($file_tmp_path, $_FILES['attachment_file']['name']);
                }
                $mail->send();
                $data=['success'=>TRUE,"msg"=>'Votre demande est bien envoyé !'];
            } 
            catch (Exception $e) {
                $data=['success'=>FALSE,"msg"=>'Erreur lors de l\'envoi du message : ', $e->getMessage()];
            }
        }
        else if($_FILES['attachment_file']['error'] !== UPLOAD_ERR_OK){
            $data=['success'=>FALSE,"msg"=>"".$_FILES['attachment_file']['error']];
        }
        else {
            $data=['success'=>FALSE,"msg"=>'Veuillez réessayer SVP !!'];
        }
        echo json_encode($data);
    }
?>