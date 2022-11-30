<?php

if(isset($_POST['submit'])){
$translation = $_POST['translation'];

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => 'q='.$translation.'&target=es&source=en',
	CURLOPT_HTTPHEADER => [
		"Accept-Encoding: application/gzip",
		"X-RapidAPI-Host: google-translate1.p.rapidapi.com",
		"X-RapidAPI-Key: //API KEY HERE//  ",
		"content-type: application/x-www-form-urlencoded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $translated = $data['data']['translations'][0]['translatedText'];
}
}else{
    $translated = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google translate</title>
</head>
<style>
    body{
        height: 100vh;
        width: 100%;
        
    }
    .card{
        width: 50%;
        height: 50%;
        margin: auto;
        margin-top: 10%;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
        padding: 20px;
    }
    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    input{
        width: 100%;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    input[type="submit"]{
        width: 100px;
        height: 40px;
        border: none;
        border-radius: 5px;
        background-color: #000;
        color: #fff;
        cursor: pointer;
    }
</style>
<body>
    <div class="card">
    
    <form action="index.php" method="POST">
        <center><h1>Google Translate ☯</h1>  </center>
        <center><h3 style="color:green;">"<?php  echo $translated ?>"</h3>  </center>
        <input type="text" name="translation" id="text">
        <input type="submit" value="submit" name="submit">
    </form>
    </div>  
</body>
</html>