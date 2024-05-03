<?php
function testFormSubmission($postData) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/contact.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Test 1: Date complete
echo "Test 1 - Date complete:\n";
$response = testFormSubmission([
    'nume' => 'Ion',
    'prenume' => 'Popescu',
    'e-mail' => 'ion.popescu@example.com',
    'numar_Telefon' => '0123456789',
    'data' => '2024-11-18',
    'ora' => '12:00',
    'detalii' => 'Detalii aici',
    'date_introduse' => 'Ok'
]);
echo $response . "\n";

// Test 2: Campuri lipsa
echo "Test 2 - Campuri lipsa:\n";
$response = testFormSubmission([
    'nume' => '',
    'prenume' => 'Popescu',
    'e-mail' => '',
    'numar_Telefon' => '0123456789',
    'data' => '2023-10-01',
    'ora' => '10:00',
    'detalii' => 'Detalii aici',
    'date_introduse' => 'Ok'
]);
echo $response . "\n";

// Test 3: Ora ocupata
echo "Test 3 - Ora deja ocupata:\n";
$response = testFormSubmission([
    'nume' => 'Ion',
    'prenume' => 'Popescu',
    'e-mail' => 'ion.popescu@example.com',
    'numar_Telefon' => '0123456789',
    'data' => '2023-10-01',
    'ora' => '10:00',  
    'detalii' => 'Detalii aici',
    'date_introduse' => 'Ok'
]);
echo $response . "\n";
?>
