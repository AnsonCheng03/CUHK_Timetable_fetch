<?php
    function curldata($url, $xmlRequest) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = [
        "Content-Type: text/xml; charset=utf-8",
        "User-Agent: ClassTT/2.4 CFNetwork/1333.0.4 Darwin/21.5.0"
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

    if(!$_REQUEST['SID'] || !$_REQUEST['pwd']) 
        die("<body style=\"margin:0;padding:0;display:flex;align-items: center;justify-content: center;font-size:2rem;\"><div>請輸入SID及密碼</div><script>setTimeout(() => {window.location.replace(\"index.html\");},2500)</script>");

    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\"><soap:Body><GetTimeTable xmlns=\"http://tempuri.org/\"><asP1>".$_REQUEST['SID']."</asP1><asP2>".$_REQUEST['pwd']."</asP2><asP3>hk.edu.cuhk.ClassTT</asP3></GetTimeTable></soap:Body></soap:Envelope>";
    $responddata = json_decode(strip_tags(curldata("https://campusapps.itsc.cuhk.edu.hk/store/CLASSSCHD/STT.asmx",$xml)), true);

    if(!$responddata)
        die("<body style=\"margin:0;padding:0;display:flex;align-items: center;justify-content: center;font-size:2rem;\"><div>帳戶名稱或密碼錯誤</div><script>setTimeout(() => {window.location.replace(\"index.html\");},2500)</script>");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename=cuhktimetable.ics');
        $currentdatetime = (new DateTime(''))->format("Ymd\THis\Z");

        echo "BEGIN:VCALENDAR\nCALSCALE:GREGORIAN\nVERSION:2.0\nX-WR-TIMEZONE:Asia/Hong_Kong\nTZID:Asia/Hong_Kong\nX-LIC-LOCATION:Asia/Hong_Kong\nX-APPLE-CALENDAR-COLOR:#FF2968\nX-WR-CALNAME:CUHK Timetable\nBEGIN:VTIMEZONE\nTZID:Asia/Hong_Kong\nEND:VTIMEZONE\n";
        foreach($responddata as $index => $value) {
            try {
                echo "BEGIN:VEVENT\nCREATED:". $currentdatetime."\nDESCRIPTION:Instructors: ".$value["INSTRUCTORS"]."\\nCourse: ".$value["DESCR"]."\nDTEND;TZID=Asia/Hong_Kong:".(new DateTime($value["START_DT"].' '.$value["MEETING_TIME_END"].':00'))->format("Ymd\THis")."\nDTSTAMP:".$currentdatetime."\nDTSTART;TZID=Asia/Hong_Kong:".(new DateTime($value["START_DT"].' '.$value["MEETING_TIME_START"].':00'))->format("Ymd\THis")."\nLAST-MODIFIED:".$currentdatetime."\nLOCATION:".$value["FDESCR"]."\nGEO:".round(trim($value["LAT"]),6).";".round(trim($value["LNG"]),6)."\nSEQUENCE:0\nSUMMARY:"."[".$value["COMDESC"]."] ".$value["SUBJECT"].$value["CATALOG_NBR"]."-".$value["CLASS_SECTION"]."\nTRANSP:OPAQUE\nRRULE:FREQ=WEEKLY;UNTIL=".$value["END_DT"]."T235959Z\nUID:".uniqid()."\nEND:VEVENT\n";
            } catch (Exception $e) {

            }
        }
        echo "END:VCALENDAR";
    } else {
        echo json_encode($responddata, JSON_PRETTY_PRINT);
    }
?>


