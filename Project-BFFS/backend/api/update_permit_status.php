<?php
/**********************************************************
 * UPDATE PERMIT STATUS API - UNIVERSITY PERMIT SYSTEM
 **********************************************************/
header('Content-Type: application/json');
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$status = $data['status'] ?? null;

if (!$id || !$status) {
    echo json_encode(['success' => false, 'message' => 'Missing ID or Status']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE permits SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Permit status updated!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No changes made or permit not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
