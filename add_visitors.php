<?php
	include 'includes/init.php';
	if(isset($_POST['add_visitors']))
	{
		$decodedData = json_decode($_POST['add_visitors'], true);
		if (json_last_error() === JSON_ERROR_NONE) {
            $date = $decodedData['date'];  

            preparerRequete("INSERT INTO visitors (date) VALUES (:date)");  
            $stmt->bindParam(':date', $date);
            executeRequete();    
            $data=['success'=>TRUE,"msg"=>'Visiteur est ajouté'];
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