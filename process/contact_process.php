<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'toggle_favorite':
                if (isset($_POST['contact_id'])) {
                    $contactId = $_POST['contact_id'];
                    $stmt = $pdo->prepare("UPDATE PERSON SET fav = IF(fav = 'Y', 'N', 'Y') WHERE id = ?");
                    $stmt->execute([$contactId]);
                    echo json_encode(['success' => true]);
                }
                break;
                
            // Add more actions as needed
        }
    }
}
?>