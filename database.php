<?php
$servername = 'mysql-2b9c8eba-chlakhna702-5683.h.aivencloud.com';  
$username = 'avnadmin';         
$password = 'AVNS_EMM0l9B433aCexcaKkt';   
$dbname = 'dpa';            
$port = 10605; 

// $kobo_api_url = 'https://eu.kobotoolbox.org/api/v2/assets/arijX3itvjmaPxmCKPgkqz/data/?format=json';
$kobo_api_url = 'https://eu.kobotoolbox.org/api/v2/assets/arijX3itvjmaPxmCKPgkqz/data/?format=json&_last_updated__gt=2024-09-18+05%3A49%3A09';
$kobo_token = 'ea97948efb2a6f133463d617277b69caff728630';  

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest submission time from the database
$sql_last_update = "SELECT MAX(submission_time) as last_updated_time FROM kobo_data";
$result = $conn->query($sql_last_update);
$last_updated_time = null;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_updated_time = $row['last_updated_time'];
}

// Prepare the API URL to fetch data submitted after the last fetch time
if ($last_updated_time) {
    $kobo_api_url .= '?_last_updated__gt=' . urlencode($last_updated_time);
}

// Set up the cURL request to fetch data from KoboToolbox
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $kobo_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Token ' . $kobo_token,
]);

// Execute the cURL request
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check if data is received
if ($http_code == 200 && isset($data['results'])) {
    foreach ($data['results'] as $record) {
        // Retrieve fields from KoboToolbox JSON data
        $submission_id = $record['_id'];
        $tstart = $record['Tstart'];
        $tend = $record['Tend'];
        $ttoday = $record['Ttoday'];
        $username = $record['username'];
        $phonenumber = $record['phonenumber'];
        $deviceid = $record['deviceid'];
        $date_interview = $record['g_location/date_interview'];
        $name_interview = $record['g_location/name_interview'];
        $sex_interview = $record['g_location/sex_interview'];
        $name_respon = $record['g_location/name_respon'];
        $sex_respon = $record['g_location/sex_respon'];
        $work_company = $record['g_location/work_company'];
        $province = $record['g_location/province'];
        $district = $record['g_location/district'];
        $commune = $record['g_location/commune'];
        $village = $record['g_location/village'];
        
        $q020101 = $record['g_q0201/q020101'];
        $q020102 = $record['g_q0201/q020102'];
        $q020103 = $record['g_q0201/q020103'];
        $q020104 = $record['g_q0201/q020104'];
        $q020105 = $record['g_q0201/q020105'];
        $q020106 = $record['g_q0201/q020106'];
        $q020201 = $record['q020201'];
        $q020203 = $record['q020203'];
        $q02020401 = $record['g_q020204/q02020401'];
        $q02020402 = $record['g_q020204/q02020402'];
        $q02020403 = $record['g_q020204/q02020403'];
        $q02020404 = $record['g_q020204/q02020404'];
        $q02020405 = $record['g_q020204/q02020405'];
        $q02020499 = $record['g_q020204/q02020499'];
        $q020205 = $record['q020205'];

        $q030101 = $record['g_q0301/q030101'];
        $q030101a = $record['g_q0301/q030101a'];
        $q030102 = $record['g_q030102/q030102'];
        $q030102a = $record['g_q030102/q030102a'];
        $q030103 = $record['q030103'];
        $q030201 = $record['g_q0302/q030201'];
        $q030301 = $record['g_q0303/q030301'];
        $q030401 = $record['g_q0304/q030401'];
        $q030402 = $record['g_q0304/q030402'];
        $q030403 = $record['g_q0304/q030403'];
        $q030404 = $record['g_q0304/q030404'];
        $q030501 = $record['g_q0305/q030501'];
        $q030502 = $record['g_q0305/q030502'];
        $q030503 = $record['g_q0305/q030503'];
        $q030601 = $record['g_q0306/q030601'];
        $q030602 = $record['g_q0306/q030602'];

        $q040101 = $record['g_q0401/q040101'];
        $q040102 = $record['g_q0401/q040102'];
        $q040103 = $record['g_q0401/q040103'];
        $q040104 = $record['g_q0401/q040104'];
        $q040201 = $record['g_q0402/q040201'];
        $q040202 = $record['g_q0402/q040202'];
        $q040301 = $record['g_q0403/q040301'];
        $q040302 = $record['g_q0403/q040302'];

        $income6month_01 = $record['g_q0501/income6month_01'];
        $income6month_02 = $record['g_q0501/income6month_02'];
        $income6month_03 = $record['g_q0501/income6month_03'];
        $income6month_04 = $record['g_q0501/income6month_04'];
        $income6month_05 = $record['g_q0501/income6month_05'];
        $income6month_06 = $record['g_q0501/income6month_06'];
        $income6month99 = $record['g_q0501/income6month99'];
        $income6month_total = $record['g_q0501/income6month_total'];
        $income_01 = $record['g_q0501/income_01'];
        $income_02 = $record['g_q0501/income_02'];
        $income_03 = $record['g_q0501/income_03'];
        $income_04 = $record['g_q0501/income_04'];
        $income_05 = $record['g_q0501/income_05'];
        $income_06 = $record['g_q0501/income_06'];
        $income99 = $record['g_q0501/income99'];
        $income_total = $record['g_q0501/income_total'];

        $q050102 = $record['q050102'];
        $q050103 = $record['q050103'];
        $q050201 = $record['g_q0502/q050201'];
        $q050202 = $record['g_q0502/q050202'];
        $q050203 = $record['g_q0502/q050203'];
        $q050204 = $record['g_q0502/q050204'];
        $animals6month_01 = $record['g_q0503/animals6month_01'];
        $animals6month_02 = $record['g_q0503/animals6month_02'];
        $animals6month_03 = $record['g_q0503/animals6month_03'];
        $animals6month_99 = $record['g_q0503/animals6month_99'];
        $animals6month_total = $record['g_q0503/animals6month_total'];
        $animals_01 = $record['g_q0503/animals_01'];
        $animals_02 = $record['g_q0503/animals_02'];
        $animals_03 = $record['g_q0503/animals_03'];
        $animals_99 = $record['g_q0503/animals_99'];
        $animals_total = $record['g_q0503/animals_total'];

        $q050302 = $record['g_q050302/q050302'];
        $q050401 = $record['q0504/q050401'];
        $q050402 = $record['q0504/q050402'];

        $comments = $record['comments'];
        $ifinish = $record['iFinish'];
        $version = $record['__version__'];
        $instance_id = $record['meta/instanceID'];
        $uuid = $record['_uuid'];
        $submission_time = $record['_submission_time'];
        $submitted_by = $record['_submitted_by'];

        // Check if the submission already exists in the database
        $sql_check = "SELECT * FROM kobo_data WHERE submission_id = '$submission_id'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // Update the existing record
            $sql_update = "UPDATE kobo_data SET 
                submission_id = '$submission_id',
                tstart = '$tstart', 
                tend = '$tend', 
                ttoday = '$ttoday', 
                username = '$username', 
                phonenumber = '$phonenumber', 
                deviceid = '$deviceid', 
                date_interview = '$date_interview', 
                name_interview = '$name_interview', 
                sex_interview = '$sex_interview', 
                name_respon = '$name_respon', 
                sex_respon = '$sex_respon', 
                work_company = '$work_company', 
                province = '$province', 
                district = '$district', 
                commune = '$commune', 
                village = '$village', 
                q020101 = '$q020101', 
                q020102 = '$q020102', 
                q020103 = '$q020103', 
                q020104 = '$q020104', 
                q020105 = '$q020105', 
                q020106 = '$q020106', 
                q020201 = '$q020201', 
                q020203 = '$q020203',
                q02020401 = '$q02020401', 
                q02020402 = '$q02020402', 
                q02020403 = '$q02020403', 
                q02020404 = '$q02020404', 
                q02020405 = '$q02020405', 
                q02020499 = '$q02020499', 
                q020205 = '$q020205', 
                q030101 = '$q030101', 
                q030101a = '$q030101a', 
                q030102 = '$q030102', 
                q030102a = '$q030102a', 
                q030103 = '$q030103', 
                q030201 = '$q030201', 
                q030301 = '$q030301', 
                q030401 = '$q030401', 
                q030402 = '$q030402', 
                q030403 = '$q030403', 
                q030404 = '$q030404', 
                q030501 = '$q030501', 
                q030502 = '$q030502', 
                q030503 = '$q030503', 
                q030601 = '$q030601', 
                q030602 = '$q030602', 
                q040101 = '$q040101', 
                q040102 = '$q040102', 
                q040103 = '$q040103', 
                q040104 = '$q040104', 
                q040201 = '$q040201', 
                q040202 = '$q040202', 
                q040301 = '$q040301', 
                q040302 = '$q040302', 
                income6month_01 = '$income6month_01', 
                income6month_02 = '$income6month_02', 
                income6month_03 = '$income6month_03', 
                income6month_04 = '$income6month_04', 
                income6month_05 = '$income6month_05', 
                income6month_06 = '$income6month_06', 
                income6month99 = '$income6month99', 
                income6month_total = '$income6month_total', 
                income_01 = '$income_01', 
                income_02 = '$income_02', 
                income_03 = '$income_03', 
                income_04 = '$income_04', 
                income_05 = '$income_05', 
                income_06 = '$income_06', 
                income99 = '$income99', 
                income_total = '$income_total', 
                q050102 = '$q050102', 
                q050103 = '$q050103', 
                q050201 = '$q050201', 
                q050202 = '$q050202', 
                q050203 = '$q050203', 
                q050204 = '$q050204', 
                animals6month_01 = '$animals6month_01', 
                animals6month_02 = '$animals6month_02', 
                animals6month_03 = '$animals6month_03', 
                animals6month_99 = '$animals6month_99', 
                animals6month_total = '$animals6month_total', 
                animals_01 = '$animals_01', 
                animals_02 = '$animals_02', 
                animals_03 = '$animals_03', 
                animals_99 = '$animals_99', 
                animals_total = '$animals_total', 
                q050302 = '$q050302', 
                q050401 = '$q050401', 
                q050402 = '$q050402', 
                comments = '$comments', 
                ifinish = '$ifinish', 
                version = '$version', 
                instance_id = '$instance_id', 
                uuid = '$uuid', 
                submission_time = '$submission_time', 
                submitted_by = '$submitted_by'
                WHERE submission_id = '$submission_id'";

            if ($conn->query($sql_update) === TRUE) {
                echo "Record updated successfully for submission ID $submission_id\n";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            // Insert a new record
            $sql_insert = "INSERT INTO kobo_data (
                submission_id, tstart, tend, ttoday, username, phonenumber, deviceid, date_interview, 
                name_interview, sex_interview, name_respon, sex_respon, work_company, province, district, commune, 
                village, q020101, q020102, q020103, q020104, q020105, q020106, q020201, q020203, q02020401, 
                q02020402, q02020403, q02020404, q02020405, q02020499, q020205, q030101, q030101a, q030102, 
                q030102a, q030103, q030201, q030301, q030401, q030402, q030403, q030404, q030501, q030502, 
                q030503, q030601, q030602, q040101, q040102, q040103, q040104, q040201, q040202, q040301, 
                q040302, income6month_01, income6month_02, income6month_03, income6month_04, income6month_05, 
                income6month_06, income6month99, income6month_total, income_01, income_02, income_03, income_04, 
                income_05, income_06, income99, income_total, q050102, q050103, q050201, q050202, q050203, 
                q050204, animals6month_01, animals6month_02, animals6month_03, animals6month_99, 
                animals6month_total, animals_01, animals_02, animals_03, animals_99, animals_total, q050302, 
                q050401, q050402, comments, ifinish, version, instance_id, uuid, submission_time, submitted_by)
                VALUES (
                '$submission_id', '$tstart', '$tend', '$ttoday', '$username', '$phonenumber', 
                '$deviceid', '$date_interview', '$name_interview', '$sex_interview', '$name_respon', '$sex_respon', 
                '$work_company', '$province', '$district', '$commune', '$village', '$q020101', '$q020102', '$q020103', 
                '$q020104', '$q020105', '$q020106', '$q020201', '$q020203', '$q02020401', '$q02020402', '$q02020403', 
                '$q02020404', '$q02020405', '$q02020499', '$q020205', '$q030101', '$q030101a', '$q030102', 
                '$q030102a', '$q030103', '$q030201', '$q030301', '$q030401', '$q030402', '$q030403', '$q030404', 
                '$q030501', '$q030502', '$q030503', '$q030601', '$q030602', '$q040101', '$q040102', '$q040103', 
                '$q040104', '$q040201', '$q040202', '$q040301', '$q040302', '$income6month_01', '$income6month_02', 
                '$income6month_03', '$income6month_04', '$income6month_05', '$income6month_06', '$income6month99', 
                '$income6month_total', '$income_01', '$income_02', '$income_03', '$income_04', '$income_05', 
                '$income_06', '$income99', '$income_total', '$q050102', '$q050103', '$q050201', '$q050202', '$q050203', 
                '$q050204', '$animals6month_01', '$animals6month_02', '$animals6month_03', '$animals6month_99', 
                '$animals6month_total', '$animals_01', '$animals_02', '$animals_03', '$animals_99', '$animals_total', 
                '$q050302', '$q050401', '$q050402', '$comments', '$ifinish', '$version', '$instance_id', '$uuid', 
                '$submission_time', '$submitted_by')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "New record created successfully for submission ID $submission_id\n";
            } else {
                echo "Error inserting new record: " . $conn->error;
            }
        }
    }
} else {
    echo "Failed to retrieve data from KoboToolbox. HTTP Code: " . $http_code;
    file_put_contents('error_log.txt', "Kobo API response: " . $response . "\n", FILE_APPEND); 
}

// Close the MySQL connection
$conn->close();
?>
