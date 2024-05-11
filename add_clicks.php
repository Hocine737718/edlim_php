<?php
	include 'includes/init.php';
	if(isset($_POST['add_clicks']))
	{
		$decodedData = json_decode($_POST['add_clicks'], true);
		if (json_last_error() === JSON_ERROR_NONE) {
            $id = $decodedData['id'];  
            preparerRequete("SELECT clicks FROM job_offers WHERE id=:id"); 
            $stmt->bindParam(':id', $id);
            $rows=executeRequete();
            if($num_rows > 0){
                foreach($rows as $row){
                    preparerRequete("UPDATE job_offers SET clicks=:clicks WHERE id=:id");  
                    $stmt->bindParam(':id', $id);
                    $clicks=$row['clicks']+1;
                    $stmt->bindParam(':clicks', $clicks);
                    executeRequete();        
                }
                $data=['success'=>TRUE,"msg"=>'Clics est modifié !'];        
            }
            else{
                $data=['success'=>FALSE,"msg"=>'Offre n\'existe pas'];
            }
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