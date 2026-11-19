<?php
/**
 * DiasporaPlug EU — Artisan Application API Endpoint
 * Handles provider applications, verification queuing, and CSV/JSON recording.
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    exit;
}

$rawInput = file_get_contents('php://input');
$inputData = json_decode($rawInput, true);

if (!is_array($inputData)) {
    $inputData = $_POST;
}

$name  = isset($inputData['name'])  ? trim($inputData['name'])  : '';
$craft = isset($inputData['craft']) ? trim($inputData['craft']) : '';
$city  = isset($inputData['city'])  ? trim($inputData['city'])  : '';
$phone = isset($inputData['phone']) ? trim($inputData['phone']) : '';

if (empty($name) || empty($craft) || empty($phone)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'error' => 'Please provide your full name, craft, and phone/WhatsApp number.'
    ]);
    exit;
}

$name  = htmlspecialchars(strip_tags($name), ENT_QUOTES, 'UTF-8');
$craft = htmlspecialchars(strip_tags($craft), ENT_QUOTES, 'UTF-8');
$city  = htmlspecialchars(strip_tags($city), ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars(strip_tags($phone), ENT_QUOTES, 'UTF-8');

$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$jsonFile = $dataDir . '/artisans.json';
$csvFile  = $dataDir . '/artisans.csv';

$artisans = [];
if (file_exists($jsonFile)) {
    $content = file_get_contents($jsonFile);
    $artisans = json_decode($content, true) ?: [];
}

$newApplication = [
    'application_id' => 'ART-' . (count($artisans) + 101),
    'name'           => $name,
    'craft'          => $craft,
    'city'           => $city,
    'phone'          => $phone,
    'status'         => 'Pending KYC Review',
    'submitted_at'   => date('c'),
    'ip_address'     => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
];

$artisans[] = $newApplication;
file_put_contents($jsonFile, json_encode($artisans, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

// Append to CSV
$csvExists = file_exists($csvFile);
$csvHandle = fopen($csvFile, 'a');
if ($csvHandle !== false) {
    if (!$csvExists || filesize($csvFile) === 0) {
        fputcsv($csvHandle, ['Application ID', 'Name', 'Craft', 'City', 'Phone', 'Status', 'Submitted At', 'IP Address'], ',', '"', '\\');
    }
    fputcsv($csvHandle, [
        $newApplication['application_id'],
        $newApplication['name'],
        $newApplication['craft'],
        $newApplication['city'],
        $newApplication['phone'],
        $newApplication['status'],
        $newApplication['submitted_at'],
        $newApplication['ip_address']
    ], ',', '"', '\\');
    fclose($csvHandle);
}

echo json_encode([
    'success' => true,
    'application_id' => $newApplication['application_id'],
    'message' => 'Artisan application received! Our onboarding team will contact you shortly.'
]);
