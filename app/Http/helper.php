<?php
function checkExternalFile($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $retCode;
}
function split_title($text)
{
    $splitstring1 = substr($text, 0, floor(strlen($text) / 2));
    $splitstring2 = substr($text, floor(strlen($text) / 2));

    if (substr($splitstring1, 0, -1) != ' ' AND substr($splitstring2, 0, 1) != ' ')
    {
        $middle = strlen($splitstring1) + strpos($splitstring2, ' ') + 1;
    }
    else
    {
        $middle = strrpos(substr($text, 0, floor(strlen($text) / 2)), ' ') + 1;    
    }

    $string1 = substr($text, 0, $middle);  // "The Quick : Brown Fox Jumped "
    $string2 = substr($text, $middle);
    return $string1.' '.$string2;
}
function cekfile($file)
{
    $file_headers = @get_headers($file);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exists = false;
    }
    else {
        $exists = true;
    }
    return $exists;
}
function getDuration($full_video_path)
{
    $getID3 = new \getID3;
    $file = $getID3->analyze($full_video_path);
    $playtime_seconds = $file['playtime_seconds'];
    $duration = date('H:i:s.v', $playtime_seconds);

    return $duration;
}
function translate($string,$from,$to)
{
    $en=array('months','years','dates','ago','minutes','hours','hour','seconds','second','minute');
    $id=array('bulan','tahun','tanggal','lalu','menit','jam','jam','detik','detik','menit');
    $res='';
    $cek=array_search($string, ${$from});
    // if($cek)
    // {
    //     if(isset(${$to}[$cek]))
    //     {
    //         $res=${$to}[$cek];
    //     }        
    // }
    return ${$to}[$cek];
    // return $res;
}
function text_translate($string,$from,$to)
{
    $dt=explode(' ',$string);
    $str='';
    foreach($dt as $k => $v)
    {
        if(is_numeric($v))
            $str.=$v.' ';
        else
            $str.=translate(trim($v),$from,$to).' ';
    }
    return ucwords($str);
}

function leveluser($level)
{
    switch($level)
    {
        case 0 :
            $lv='Super Admin';
            break;
        case 1 :
            $lv='Admin';
            break;
        case 2 :
            $lv='Super User';
            break;
        case 3 :
            $lv='Reviewer';
            break;
        case 4 :
            $lv='Contributor';
            break;
        case 5 :
            $lv='PIC Fasilitasi';
            break;
    }
    return $lv;
}
function level()
{
    $lv=array('Super Admin','Admin','Super User','Reviewer','Contributor','PIC Fasilitasi');
    return $lv;
}
function getstar($nilai)
{
    if($nilai>90 && $nilai<=100)
        $star=5;
    elseif($nilai<=90 && $nilai>80)
        $star=4;
    elseif($nilai<=80 && $nilai>70)
        $star=3;
    elseif($nilai<=70 && $nilai>60)
        $star=2;
    elseif($nilai<=60 && $nilai>50)
        $star=1;
    else
        $star=0;
    return $star;
}
function rating($star)
{
    $s1=$star;
    $s2=5-$star;
    $s='';
    if($star>0)
    {

        for($i=1;$i<=$s1;$i++)
        {
            $s.='<span class="fa fa-star checked"></span>';
        }
        for($j=1;$j<=$s2;$j++)
        {
            $s.='<span class="fa fa-star"></span>';
        }
    }
    return $s;
}

function validate_js($data)
{
    $data2=array();
    foreach($data as $k => $v)
    {
        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_title = preg_replace($tagsToStrip, '-', $v);
        $data2[$k]=$m_title;
    }
    return $data2;
}
function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}
	function tgl_indo2($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulanSingkat(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}
	
	function tbt($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$tahun = substr($tgl,2,2);
			return $tanggal.'-'.$bulan.'-\''.$tahun;
	}
	
	function tgl_indo_time($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			$jam = substr($tgl,11,2);
			$menit = substr($tgl,14,2);
			$detik = substr($tgl,17,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam.':'.$menit.':'.$detik.' WIB';
	}	function tgl_indo_time2($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulanSingkat(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			$jam = substr($tgl,11,2);
			$menit = substr($tgl,14,2);
			$detik = substr($tgl,17,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam.':'.$menit.':'.$detik.' WIB';
	}
	function tgl_bulan($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulanSingkat(substr($tgl,5,2));
			return $tanggal.' '.$bulan;
	}

	function tanggal($date)
	{
		list($tgl,$bln,$thn)=explode(' ', trim($date));
		$bln=strtolower($bln);
		
		if($bln=='januari' || $bln=='jan')
			$b='01';
		else if($bln=='februari' || $bln=='feb')
			$b='02';
		else if($bln=='maret' || $bln=='mar')
			$b='03';
		else if($bln=='april' || $bln=='apr')
			$b='04';
		else if($bln=='mei' || $bln=='may')
			$b='05';
		else if($bln=='juni' || $bln=='jun')
			$b='06';
		else if($bln=='juli' || $bln=='jul')
			$b='07';
		else if($bln=='agustus' || $bln=='ags' || $bln=='agust')
			$b='08';
		else if($bln=='september' || $bln=='sept')
			$b='09';
		else if($bln=='oktober' || $bln=='okt')
			$b='10';
		else if($bln=='november' || $bln=='nov')
			$b='11';		
		else if($bln=='desember' || $bln=='des')
			$b='12';
		else
			$b='00';

		return $thn.'-'.$b.'-'.$tgl;
	}
	function getBulanSingkat($bln)
	{
				switch ($bln){
					case 1:
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Ags";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
				}
		
	}
	function getBulanEn($bln)
	{
				switch ($bln){
					case 1:
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "May";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Aug";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Oct";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Dec";
						break;
				}
		
	}

	function getBulanReverse($bln)
	{
				switch ($bln){
					case "Jan":
						return 1;
						break;
					case "Feb":
						return 2;
						break;
					case "Mar":
						return 3;
						break;
					case "Maret":
						return 3;
						break;
					case "Apr":
						return 4;
						break;
					case "May":
						return 5;
						break;
					case "Apr":
						return 6;
						break;
					case "Jul":
						return 7;
						break;
					case "Aug":
						return 8;
						break;
					case "Agu":
						return 8;
						break;
					case "Agt":
						return 8;
						break;
					case "Sep":
						return 9;
						break;
					case "Sept":
						return 9;
						break;
					case "Oct":
						return 10;
						break;
					case "Okt":
						return 10;
						break;
					case "Nov":
						return 11;
						break;
					case "Dec":
						return 12;
						break;					
					case "Des":
						return 12;
						break;
				}
		
	}
	function getBulan($bln){
				switch ($bln){
					case 1:
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}
			
            function jumlah_hari($bulan = 0, $tahun = '')
{
    if ($bulan < 1 OR $bulan > 12)
    {
  return 0;
    }
    if ( ! is_numeric($tahun) OR strlen($tahun) != 4)
    {
  $tahun = date('Y');
    }
    if ($bulan == 2)
    {
  if ($tahun % 400 == 0 OR ($tahun % 4 == 0 AND $tahun % 100 != 0))
  {
  return 29;
  }
    }
    $jumlah_hari    = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    return $jumlah_hari[$bulan - 1];
}

function createDateRange($startDate, $endDate, $format = "Y-m-d")
{
    $begin = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D'); // 1 Day
    $dateRange = new DatePeriod($begin, $interval, $end);

    $range = [];
    foreach ($dateRange as $date) {
        $range[] = $date->format($format);
    }
    $range[]=$endDate;
    return $range;
}
function getMinutes($start_time,$end_time)
{
    $d1 = strtotime($start_time);
    $d2 = strtotime($end_time);
    $diff = ($d2-$d1)/60;
    return $diff;
}
function hari($day)
{
    switch($day)
    {
        case 'Mon' : return 'Senin';
        case 'Tue' : return 'Selasa';
        case 'Wed' : return 'Rabu';
        case 'Thu' : return 'Kamis';
        case 'Fri' : return 'Jumat';
        case 'Sat' : return 'Sabtu';
        case 'Sun' : return 'Minggu';
    }
}
function waktu()
{
	$waktu=array('08.00','08.30','09.00','09.30','10.00','10.30','11.00','11.30','12.00','12.30','13.00','13.30','14.00','14.30','15.00','15.30','16.00','16.30','17.00','17.30','18.00','18.30','19.00','19.30','20.00','20.30','21.00','21.30','22.00');
	return $waktu;
}
function akses()
{
	$akses=array('Semua Menu','Manajemen Pelatihan','Manajemen Jadwal','Manajemen Peserta','Manajemen User','Master Data','Pengaturan Sistem');
	return $akses;
}
function getFormFields($data)
    {
        if (preg_match('/(<form "*?<\/form>)/is', $data, $matches)) {
            $inputs = getInputs($matches[1]);

            return $inputs;
        } else {
            die('didnt find login form');
        }
    }

    function getInputs($form)
    {
        $inputs = array();

        $elements = preg_match_all('/(<input[^>]+>)/is', $form, $matches);

        if ($elements > 0) {
            for($i = 0; $i < $elements; $i++) {
                $el = preg_replace('/\s{2,}/', ' ', $matches[1][$i]);

                if (preg_match('/name=(?:["\'])?([^"\'\s]*)/i', $el, $name)) {
                    $name  = $name[1];
                    $value = '';

                    if (preg_match('/value=(?:["\'])?([^"\'\s]*)/i', $el, $value)) {
                        $value = $value[1];
                    }

                    $inputs[$name] = $value;
                }
            }
        }

        return $inputs;
	}
	
	function ujians3()
	{
		$ujian=['Ujian Proposal Riset','Ujian Hasil Riset','Sidang Promosi'];
		return $ujian;
	}

	function jab_promotor()
	{
		$jab=['professor','profesor','guru-besar','lektor-kepala'];
		return $jab;
	}
	function jab_copromotor()
	{
		$jab=['lektor','guru-besar'];
		return $jab;
	}
	function departemeninggris($dept)
	{
		$dept_name=['Departemen Teknik Sipil','Departemen Teknik Mesin','Departemen Teknik Elektro','Departemen Teknik Metalurgi dan Material','Departemen Teknik Kimia','Departemen Arsitektur','Departemen Teknik Industri'];
		$name=array();
		foreach($dept_name as $k=>$v)
		{
			$name[$k]=str_slug($v);
		}

		$eng=['Department of Civil Engineering','Departemen of Mechanical Engineering','Department of Electrical Engineering','Department of Metallurgical and Material Engineering','Department of Chemical Engineering','Department of Architecture','Department of Industrial Engineering'];

		$key=array_search($dept,$name);

		return isset($eng[$key]) ? $eng[$key] : '';

	}
?>