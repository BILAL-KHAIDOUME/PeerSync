<?php

/**
 * PeerSync Registration Test Script
 * Tests if registration API is working correctly
 */

// Configuration
$baseUrl = 'http://localhost:8000';

// Test data
$testData = [
    'nom' => 'Khaidoume',
    'prenom' => 'Bilal',
    'email' => 'bilal@example.com',
    'password' => 'TestPass123',
    'role' => 'student'
];

echo "========================================\n";
echo "🧪 PeerSync Registration Test\n";
echo "========================================\n\n";

// Test 1: Check API endpoint
echo "Test 1: Checking API endpoint...\n";
$apiUrl = $baseUrl . '/api/auth/register';
echo "URL: $apiUrl\n";

// Test 2: Send registration request
echo "\nTest 2: Sending registration request...\n";
echo "Data: " . json_encode($testData, JSON_PRETTY_PRINT) . "\n\n";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testData));
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status: $httpCode\n";

if ($error) {
    echo "❌ CURL Error: $error\n";
    echo "\nTroubleshooting:\n";
    echo "- Make sure server is running: php -S localhost:8000 -t public\n";
    echo "- Make sure MySQL is running\n";
    echo "- Check database is created: mysql -u root < sql/structure.sql\n";
    exit;
}

echo "Response:\n";
$result = json_decode($response, true);

if ($result) {
    echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
    
    if ($result['success']) {
        echo "\n✅ Registration successful!\n";
        echo "User ID: " . $result['data']['user_id'] . "\n";
    } else {
        echo "\n❌ Registration failed: " . $result['message'] . "\n";
    }
} else {
    echo "❌ Invalid JSON response. Raw response:\n";
    echo $response . "\n";
}

echo "\n========================================\n";
echo "Test Complete\n";
echo "========================================\n";
