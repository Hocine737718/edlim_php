<?php
	include 'includes/init.php';
	if(isset($_POST['services_stats']))
	{
            preparerRequete("SELECT type_service FROM service WHERE is_deleted=0"); 
            $rows=executeRequete();
            $stats=[];
            if($num_rows > 0){
                $service_nb=0;
                $type_services=[];
                $values=[];
                foreach($rows as $row){ 
                    $service_nb=$service_nb+1;
                    if (array_key_exists($row['type_service'], $values))
                    {
                        $values[$row['type_service']]=$values[$row['type_service']]+1; 
                    } 
                    else 
                    {
                        $values[$row['type_service']]=1; 
                        array_push($type_services, $row['type_service']);  
                    }
                }
                $stats['service_nb']=$service_nb;
                $stats['type_services']=$type_services;
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