<?php
if(!function_exists('level_help')){
	function level_help($params){
        $res = '';
		if($params == 1){
			$res = 'Super Admin';
		}else if($params == 2){
			$res = 'Admin PPPU';
        }else if($params == 3){
            $res = 'Sales';
        }

		return $res;
    }
}

 if(!function_exists('debugVar')){
function debugVar($var, $exit = false) {
	echo '<pre style="font-size:11px;">';
 
	if (is_array($var) || is_object($var)) {
		echo htmlentities(print_r($var, true));
	} elseif (is_string($var)) {
		echo "string(" . strlen($var) . ") \"" . htmlentities($var) . "\"\n";
	} else {
		var_dump($var);
	}
 
	echo "\n</pre>";
 
	if ($exit) {
		exit;
	}
}
 }
 
if(!function_exists('bagi_nama_div')){
    function bagi_nama_div($string){
    $total = str_word_count($string);
     $batas = "3";
     $count = $total-$batas;
     $kata1 = implode(" ", array_slice(explode(" ", $string), 0, $batas));
     $separator = "<br>";
     $kata2 = implode(" ", array_slice(explode(" ", $string),$batas, $count));
    
     $res = $kata1.$separator.$kata2;
     return $res;
    }
}

 function kekata($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x < 12) {
            $temp = " " . $angka[$x];
        } else if ($x < 20) {
            $temp = kekata($x - 10) . " belas";
        } else if ($x < 100) {
            $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
        } else if ($x < 200) {
            $temp = " seratus" . kekata($x - 100);
        } else if ($x < 1000) {
            $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
        } else if ($x < 2000) {
            $temp = " seribu" . kekata($x - 1000);
        } else if ($x < 1000000) {
            $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
        } else if ($x < 1000000000) {
            $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
        } else if ($x < 1000000000000000) {
            $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
        }
        return $temp;
    }
if(!function_exists('acakangkahuruf')){
    
function acakangkahuruf($params)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $params; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

function generate_kode_pelanggan($params){
    $karakter= '1234567890';
    $string = '';
    for ($i = 0; $i < $params; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
    }
    return $string;
}

function generate_no_pu($params){
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $string = '';
    for ($i = 0; $i < $params; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
    }
    return $string;
}

function generate_ttbf($params){
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $string = '';
    for ($i = 0; $i < $params; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
    }
    return $string;
}

function generate_kp(){
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $params; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
    }
    return $string;
}

}
if (!function_exists('tanggalan')) {

    function tanggalan($tanggal) {
        $getyear = substr($tanggal, 0, 4);
        $getmonth = substr($tanggal, 5, 2);
        $getdate = substr($tanggal, 8, 2);

        switch ($getmonth) {
            case "01":
                $bulan = "Januari";
                break;

            case "02":
                $bulan = "Februari";
                break;

            case "03":
                $bulan = "Maret";
                break;

            case "04":
                $bulan = "April";
                break;

            case "05":
                $bulan = "Mei";
                break;

            case "06":
                $bulan = "Juni";
                break;

            case "07":
                $bulan = "Juli";
                break;

            case "08":
                $bulan = "Agustus";
                break;

            case "09":
                $bulan = "September";
                break;

            case "10":
                $bulan = "Oktober";
                break;

            case "11":
                $bulan = "November";
                break;

            case "12":
                $bulan = "Desember";
                break;

            default:
                $bulan = "";
                break;
        }

        $hasil = $getdate . ' ' . $bulan . ' ' . $getyear;

        return $hasil;
    }

}
if(!function_exists('limit_to_numwords')){
    function limit_to_numwords($string, $numwords) {
        $excerpt = explode(' ', $string, $numwords + 1);
        if (count($excerpt) >= $numwords) {
            array_pop($excerpt);
        }
        $excerpt = implode(' ', $excerpt);
        return $excerpt;
    }
}

 

if(!function_exists('e')){
    function e($string) {
        return htmlentities($string);
    }
}

 ?>
