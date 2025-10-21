<?php  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "db.php";

$id = $_POST['id'];
$content = $_POST['content'];
$visible = $_POST['visible'];

$sql = "UPDATE reviews SET content = ?, visible = ?, updated_at = NOW() WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $content, $visible, $id);

$response = [];

if ($stmt->execute()) {
    $response['status'] = 'success';
} else {
    $response['status'] = 'error';
    $response['message'] = $conn->error;
}

echo json_encode($response);