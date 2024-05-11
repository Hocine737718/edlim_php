<?php
	include 'includes/init.php';
	if(isset($_POST['get_nb_views']))
	{
        preparerRequete("SELECT id  FROM visitors");
		$rows=executeRequete();
        $data=['success'=>TRUE,"msg"=>"Nombre Visiteurs est prêt !","content"=>$num_rows];
	}
    else {
		$data=['success'=>FALSE,"msg"=>'Veuillez réessayer SVP !!'];
	}
    echo json_encode($data);    
?>