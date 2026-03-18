<?php
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

$sql = "SELECT * FROM bcg";
$sql1 = mysqli_query($conn, $sql);
$command = mysqli_num_rows($sql1);

if ($command > 0) {
	while ($row = mysqli_fetch_assoc($sql1)) {
		$batch = $row['Batchno'];
			$sql2 = "SELECT * FROM vaccination_data where Batchno='$batch'";
			$sql3 = mysqli_query($conn, $sql2);
			$write = mysqli_fetch_assoc($sql3);
			$phone = "+250787539625";
			$msg = "Muraho " . $write['Father_name'] . ",umwana wanyu witwa " . $write['Child_names'] ." ". "akingiwe urukingo rw'igituntu uyu munsi kuwa ".date('Y-m-d')." "."azafata urukurikira rw'imbasa kuwa " . $row['Bcg_sms'].". Murakoze!";
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
