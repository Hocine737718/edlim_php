<?php
	include 'includes/init.php';
	if(isset($_POST['get_offers']))
	{
        preparerRequete("SELECT id,title,clicks,link  FROM job_offers WHERE is_deleted=0");
		$rows=executeRequete();
		if($num_rows > 0){
            $offers=array();
            foreach($rows as $row){
                $offer= [
                    "id" =>$row['id'],
                    "title" => $row['title'],
                    "clicks" => $row['clicks'],
                    "link" => $row['link']
                ];
                $offers[]=$offer;
            }
			$data=['success'=>TRUE,"msg"=>"Offres sont prêts !","content"=>$offers];
		}
		else{
			$data=['success'=>FALSE,"msg"=>'Aucun Offre existe  !!'];
		}  
	}
    else {
		$data=['success'=>FALSE,"msg"=>'Veuillez réessayer SVP !!'];
	}
    echo json_encode($data);    
?>