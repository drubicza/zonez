<?php
$banner = "
\033[0;32m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
\033[1;33m   ____                                      ___  ___
  \033[1;33m/  _/__  ___ __ _________ ____  _______   / _ \/ _ \
 \033[1;34m_/ // _ \(_-</ // / __/ _ `/ _ \/ __/ -_) / , _/ ___/
\033[1;34m/___/_//_/___/\_,_/_/  \_,_/_//_/\__/\__/ /_/|_/_/
\033[0;32m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
\033[1;34m                   CREATED BY :
\033[0;32m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
\033[1;34m              +-+-+-+-+-+ +-+-+-+-+-+
\033[1;34m              |Z|O|N|E|Z| |S|Q|U|A|D|
\033[1;34m              +-+-+-+-+-+ +-+-+-+-+-+
\033[0;32m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
\033[1;31mðŸš«Kami tidak bertanggung jawab
\033[1;31mjika segala apapun yang terjadi pada akun anda
\033[0;32m━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
";

function buatconf()
{
    echo "\033[1;33mManjingna IMEI Fak =>> : ";
    $iemei    = trim(fgets(STDIN));
    $config   = array('Imei' => $iemei);
    $jsonfile = json_encode($config, JSON_PRETTY_PRINT);
    file_put_contents('config.json', $jsonfile);
    echo "\n";
}

$file      = "config.json";
$konfigson = file_get_contents($file);
$datason   = json_decode($konfigson, true);

if ($datason["Imei"] == false) {
    system("clear");
    echo $banner;
    buatconf();
}

system("clear");
echo $banner;

$file      = "config.json";
$konfigson = file_get_contents($file);
$datason   = json_decode($konfigson, true);
$memei     = "".$datason["Imei"]."";
$saldo     = "http://icar.freerupiah.online/api/saldo.php?id=$memei";
$date      = date('D, d M Y H:i:s');
$gmt       = "GMT+00:00";
$headers   = array();
$headers[] = "Accept-Encoding: application/json";
$headers[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 4.1.2; GT-N7100 Build/JZO54K)";
$headers[] = "If-Modified-Since: ".$date .$gmt;

function saldo($saldo, $headers)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $saldo);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cook.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cook.txt");

    $resdo = curl_exec($ch);
    $js    = json_decode($resdo, true);
    echo "\033[1;34mSaldo\033[1;31m : \033[33;1m".$js["result"]["0"]["saldo"]." \n";
}

$index = "http://icar.freerupiah.online/api/getprofile.php?id=$memei";
$ch    = curl_init();

curl_setopt($ch, CURLOPT_URL, $index);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cook.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cook.txt");

$resultt    = curl_exec($ch);
$json_index = json_decode($resultt, true);

echo "\033[1;31m[Ã·]\033[1;34mNama\033[1;31m  : \033[33;1m".$json_index["result"]["0"]["nama"]."\033[1;31m [Ã·]\033[1;34mUsername \033[1;31m: \033[33;1m".$json_index["result"]["0"]["telp"]." \n";

while (true) {
    $cek = "http://icar.freerupiah.online/api/getmisi.php?id=$memei";
    $ch  = curl_init();

    curl_setopt($ch, CURLOPT_URL, $cek);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cook.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cook.txt");

    $rescek = curl_exec($ch);
    $json   = json_decode($rescek, true);

    if ($json["result"][0]["idmisi"] == false) {
        echo "\033[1;31m[=]\033[1;32mNgopi dulu fakk..!! \n";
        sleep(60);
    } else {
        for ($i = 0; $i < count($json["result"]); $i++) {
            $kode  = "".$json["result"][$i]["idmisi"]."";
            date_default_timezone_set('Asia/Jakarta');
            $date3 = date('H:i:s');
            $point = "http://icar.freerupiah.online/api/updatemisiplay.php";
            $data  = "imei=$memei&idmisi=$kode&";
            $ch    = curl_init();

            curl_setopt($ch, CURLOPT_URL, $point);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_COOKIEJAR, "cook.txt");
            curl_setopt($ch, CURLOPT_COOKIEFILE, "cook.txt");

            $respon    = curl_exec($ch);
            $json_misi = json_decode($respon, true);

            if ($respon == true) {
                echo "\033[1;31m[\033[1;32m$date3\033[1;31m]\033[33;1m$respon\033[35;1m||";
            } else {
                echo "\033[1;31m[Ã—]\033[31;1mMisi sudah selesai sialakan tunggu 1jam kemudian";
            }

            saldo($saldo, $headers);
            echo "\033[1;31m[=]\033[1;32mSabar yah Bot sedang berjalan kamfret!!..\n";
            $timer = array("880","761","852","923","824","875","896","867","908");
            sleep($timer[rand(0, 8)]);
        }
    }
}
?>
