<?php
	include 'includes/init.php';
	if(isset($_POST['line_business_stats']))
	{
        preparerRequete("SELECT name, nb_clients FROM line_business WHERE is_deleted=0"); 
        $rows=executeRequete();
        $stats=[];
        if($num_rows > 0){
            $line_business_nb=$num_rows;
            $values=[];
            $names=[];
            foreach($rows as $row){ 
                $values[$row['name']]=$row['nb_clients'];
                array_push($names, $row['name']);  
            }
            $stats['line_business_nb']=$line_business_nb;
            $stats['names']=$names;
            $stats['values']=$values;
            $data=['success'=>TRUE,"msg"=>'Les statistiques sont bien calculées !',"content"=>$stats];        
        }
        else{
            $data=['success'=>TRUE,"msg"=>'Aucun calcul n\'est exécuté car aucune donnée n\'est trouvée !',"content"=>$stats];
        }
    }
    else {
		$data=['success'=>FALSE,"msg"=>'Veuillez réessayer SVP !!'];
	}
    echo json_encode($data);   
?>