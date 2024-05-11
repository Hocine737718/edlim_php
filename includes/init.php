<?php
	// Set the content type to JSON
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin:  http://localhost:8080');  // Replace with the origin of your Vue.js app
	header('Access-Control-Allow-Methods: POST, OPTIONS'); // Add any additional methods your API supports
	header('Access-Control-Allow-Headers: Content-Type');  // Add any additional headers your API supports
	// PDO
	try {
		//$pdo = new PDO("mysql:host=sql112.infinityfree.com;dbname=if0_36006183_gms_db;charset=utf8mb4", "if0_36006183", "pRFTuFEx");
		$pdo = new PDO("mysql:host=localhost;dbname=gms_db;charset=utf8mb4", "root", "");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt='';
		$num_rows='';
	} 
	catch (PDOException $e) {
		$data=array("error",'Un problème est survenu lors de la tentative de connexion à la BDD : ' . $e->getMessage());
		echo json_encode($data);
		die();
	}
	function preparerRequete($req){
		global $pdo,$stmt;
		$stmt = $pdo->prepare($req);
	}
	function executeRequete(){
		try{
			global $stmt,$num_rows;
			$stmt->execute();
			$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$num_rows=$stmt->rowCount();
			$stmt->closeCursor();
			return $res;
		}
		catch (PDOException $e) {
			$data=['success'=>FALSE,"msg"=>"Un problème est survenu lors de l'exécution d'une requête : " . $e->getMessage()];
			echo json_encode($data);
			die();
		}
	}
	/*preparerRequete("SELECT code_recup FROM client");
	executeRequete();
	$next=intval($num_rows)+1;
	preparerRequete("SELECT id FROM commande");
	executeRequete();
	$nextC=intval($num_rows)+1;*/
?>