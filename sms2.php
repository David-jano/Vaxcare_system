<?php

// ===================================================================
// $servername = "localhost";
// $username = "deogratias";
// $password = "WdeHjHPohbCbf4HT";
// $dbname = "byumba_hospital";

$host = '127.0.0.1';
// $port = '3306';
$dbname = 'byumba_hospital';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

$polio = "SELECT * FROM polio";
$polio1 = mysqli_query($conn, $polio);
$polioCommand = mysqli_num_rows($polio1);

if ($polioCommand > 0) {
	while ($row = mysqli_fetch_assoc($polio1)) {
		$batch = $row['Batchno'];
			$sql2 = "SELECT * FROM vaccination_data where Batchno='$batch'";
			$sql3 = mysqli_query($conn, $sql2);
			$write = mysqli_fetch_assoc($sql3);
			$phone = "+250787539625";
			$msg = "Muraho " . $write['Father_name'] . ", turakwibutsa ko umwana wawe witwa " . $write['Child_names'] ." ". "akingiwe urukingo rw'imbasa  uyu munsi kuwa"." ".date('Y-m-d')." "."azafata urukurikira rw'imbasa kuwa " . $row['Sms'].". Murakoze!";
			$data1 = array(
				"sender" => "+250786964793",
				"recipients" => '+250' . $write['Father_phone'],
				"message" => $msg
			);

			$url = "https://www.intouchsms.co.rw/api/sendsms/.json";

			$data = http_build_query($data1);

			$username = "Delinga";
			$password = "12345678";

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			//execute post
			$result = curl_exec($ch);
		    $result;
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			//close connection
			curl_close($ch);
		} 
	}







?>
