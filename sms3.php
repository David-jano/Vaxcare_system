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
			$sql2 = "SELECT p.*, v.*
            FROM polio AS p
            INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno
            WHERE p.Batchno = '$batch'";
			$sql3 = mysqli_query($conn, $sql2);
			$write = mysqli_fetch_assoc($sql3);
$status=$write['Status'];
$status1=$write['Status2'];
$status2=$write['Status3'];
$status3=$write['Status4'];

if($status=='Yes'){
    $view='Yego';
}
else
{
    $view='Oya'; 
}

if($status1=='Yes'){
    $view1='Yego';
}
else
{
    $view1='Oya'; 
}

if($status2=='Yes'){
    $view2='Yego';
}
else
{
    $view2='Oya'; 
}

if($status3=='Yes'){
    $view3='Yego';
}
else
{
    $view3='Oya'; 
}
			$phone = "+250787539625";
			$msg = "Muraho " . $write['Father_name'] . ",umwana wanyu witwa " . $write['Child_names'] ." ". "amaze gukingirwa inkingo zikurikira, Igituntu: Yego , imbasa ya mbere:"." ".$view.", Imbasa ya kabiri:"." ".$view1.", Imbasa ya Gatatu:"." ".$view2.", Imbasa ya Kane:"." ".$view3.", azafata urukurikira rw'imbasa kuwa " . $write['Sms'].". Murakoze!";
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
