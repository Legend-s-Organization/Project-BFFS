<?php
/**********************************************************
 * SECURE SIGNUP API - UNIVERSITY PERMIT SYSTEM
 **********************************************************/
header('Content-Type: application/json');
require_once '../config/db.php';

// Get JSON data from POST request
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Missing username or password']);
    exit;
}

$username = trim($data['username']);
$password = $data['password'];

try {
    // Check if student ID already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE student_id = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Student ID already exists']);
        exit;
    }

    // Securely hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into database
    $stmt = $pdo->prepare("INSERT INTO users (student_id, password, role) VALUES (?, ?, 'student')");
    $stmt->execute([$username, $hashedPassword]);

    echo json_encode(['success' => true, 'message' => 'Account created successfully!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
