<?php
	include 'includes/init.php';
	if(isset($_POST['news_letter']))
	{
		$decodedData = json_decode($_POST['news_letter'], true);
		if (json_last_error() === JSON_ERROR_NONE) {
            $email = $decodedData['email'];  
            preparerRequete("SELECT id FROM news_letter WHERE email=:email"); 
            $stmt->bindParam(':email', $email);
            executeRequete();
            if($num_rows == 0){
                preparerRequete("INSERT INTO news_letter (email) VALUES (:email)");  
                $stmt->bindParam(':email', $email);
                executeRequete();                
            }
            $data=['success'=>TRUE,"msg"=>'Votre email est ajouté à la newsletter'];
        }
        else {
            $data=['success'=>FALSE,"msg"=>'Erreur de décodage JSON: ' . json_last_error_msg()];
        }
	}
    else {
		$data=['success'=>FALSE,"msg"=>'Veuillez réessayer SVP !!'];
	}
    echo json_encode($data);    
?>