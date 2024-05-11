<?php
include 'includes/init.php';
if(isset($_GET['filename'])) {
    $filename = 'files/' . $_GET['filename'];
    if (file_exists($filename)) {
        // Définit les en-têtes HTTP pour indiquer qu'il s'agit d'un téléchargement de fichier
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        // Envoie le fichier au client
        readfile($filename);
        exit();
    } 
    else {
        // Si le fichier n'existe pas, retourne une erreur 404
        http_response_code(404);
        // Ne pas fournir de détails sur le fichier manquant pour des raisons de sécurité
    }
}
else {
    // Si $_GET['filename'] n'est pas défini, retourner une réponse appropriée
    echo "Veuillez réessayer SVP !!";
}
?>
