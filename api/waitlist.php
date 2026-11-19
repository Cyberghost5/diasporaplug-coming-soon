<?php
/**
 * DiasporaPlug EU — Waitlist API Endpoint
 * Handles email capture, validation, deduplication, CSV/JSON persistence, and position assignment.
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method Not Allowed. Please send a POST request.'
    ]);
    exit;
}

// Read and decode input data (supports both JSON body and standard Form POST)
$rawInput = file_get_contents('php://input');
$inputData = json_decode($rawInput, true);

if (!is_array($inputData)) {
    $inputData = $_POST;
}

$email = isset($inputData['email']) ? trim($inputData['email']) : '';
$city  = isset($inputData['city'])  ? trim($inputData['city'])  : 'Paris';

// Validate email address
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'error' => 'Please provide a valid email address.'
    ]);
    exit;
}

// Sanitize city input
$city = htmlspecialchars(strip_tags($city), ENT_QUOTES, 'UTF-8');
if (empty($city)) {
    $city = 'EU';
}

// Data directory setup
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Security: Prevent direct web access to the data directory
$htaccessPath = $dataDir . '/.htaccess';
if (!file_exists($htaccessPath)) {
    file_put_contents($htaccessPath, "Deny from all\n");
}

$jsonFile = $dataDir . '/waitlist.json';
$csvFile  = $dataDir . '/waitlist.csv';

// Initialize or read existing waitlist records
$waitlist = [];
if (file_exists($jsonFile)) {
    $content = file_get_contents($jsonFile);
    $waitlist = json_decode($content, true) ?: [];
}

// Check for existing registration
$existingEntry = null;
foreach ($waitlist as $item) {
    if (strtolower($item['email']) === strtolower($email)) {
        $existingEntry = $item;
        break;
    }
}

if ($existingEntry !== null) {
    // Return existing position without duplication
    echo json_encode([
        'success' => true,
        'already_registered' => true,
        'position' => $existingEntry['position'],
        'referral_code' => $existingEntry['referral_code'],
        'email' => $existingEntry['email'],
        'city' => $existingEntry['city'],
        'message' => 'You are already on the waitlist! We retrieved your existing VIP ticket.'
    ]);
    exit;
}

// Base counter offset (matching the pre-launch count of 1,428 members)
$baseOffset = 1428;
$currentCount = count($waitlist);
$newPosition = $baseOffset + $currentCount + 1;
$referralCode = 'DP-' . $newPosition;
$timestamp = date('c');
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

// Create new entry record
$newEntry = [
    'position'      => $newPosition,
    'referral_code' => $referralCode,
    'email'         => $email,
    'city'          => $city,
    'created_at'    => $timestamp,
    'ip_address'    => $ipAddress
];

// Append to JSON storage
$waitlist[] = $newEntry;
file_put_contents($jsonFile, json_encode($waitlist, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

// Append to CSV storage (Excel-ready format)
$csvExists = file_exists($csvFile);
$csvHandle = fopen($csvFile, 'a');
if ($csvHandle !== false) {
    if (!$csvExists || filesize($csvFile) === 0) {
        fputcsv($csvHandle, ['Position', 'Referral Code', 'Email', 'City', 'Created At', 'IP Address'], ',', '"', '\\');
    }
    fputcsv($csvHandle, [
        $newEntry['position'],
        $newEntry['referral_code'],
        $newEntry['email'],
        $newEntry['city'],
        $newEntry['created_at'],
        $newEntry['ip_address']
    ], ',', '"', '\\');
    fclose($csvHandle);
}

// Return success response
echo json_encode([
    'success' => true,
    'already_registered' => false,
    'position' => $newPosition,
    'referral_code' => $referralCode,
    'email' => $email,
    'city' => $city,
    'message' => 'Registration confirmed! Welcome to DiasporaPlug EU.'
]);
