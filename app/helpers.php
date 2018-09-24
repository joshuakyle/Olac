<?php

use App\Model\Teacher;
use App\Model\Student;
if(!function_exists("getYearValue")){
    function getYearValue($yearText)
    {
        if($yearText == 'First Year')
            return 1;
        elseif($yearText == 'Second Year')
            return 2;
        elseif($yearText == 'Third Year')
            return 3;
        else
            return 4;
    }
}

if(!function_exists("getYearText")){
    function getYearText($yearValue)
    {
        if($yearValue == 1)
            return 'First Year';
        elseif($yearValue == 2)
            return 'Second Year';
        elseif($yearValue == 3)
            return 'Third Year';
        elseif($yearValue == 4)
            return 'Fourth Year';
        else
            return 'Grade Six';
    }
}

if(!function_exists("getListofSchedule")){
    function getListofSchedule()
    {
        return (object)[
            '1' => '8:00am - 9:00am', //english
            '2' => '9:00am - 10:00am', //math
            '3' => '10:00am - 11:00am', //science
            '4' => '11:00am - 12:00nn',//values
            '5' => '1:00pm - 2:00pm',//filipino
            '6' => '3:00pm - 4:00pm',//Ap
            '7' => '4:00pm - 5:00pm'//MAPeH
        ];
    }
}

if(!function_exists("getListofScheduleText")){
    function getListofScheduleText($param)
    {
        $arr = [
            '1' => '8:00am - 9:00am', //english
            '2' => '9:00am - 10:00am', //math
            '3' => '10:00am - 11:00am', //science
            '4' => '11:00am - 12:00nn',//values
            '5' => '1:00pm - 2:00pm',//filipino
            '6' => '3:00pm - 4:00pm',//Ap
            '7' => '4:00pm - 5:00pm'//MAPeH
        ];

        return $arr[$param];
    }
}

if(!function_exists("getTeacher")){
    function getTeacher($id)
    {
        $teacher = new Teacher;
        $query = $teacher->where('user_id',$id)->first();
        return $query->last_name;
    }
}

if(!function_exists("unStudents")){
    function unStudents()
    {
        $student = new Student;
        return $student->where('status',0)->get();
        
    }
}

if(!function_exists("getScheduledSubject")){
    function getScheduledSubject($id)
    {
        $time = time();
        $_8 = strtotime("08:00");
        $_9 = strtotime("09:00");
        $_10 =strtotime("10:00");
        $_11 =strtotime("11:00");
        $_12 =strtotime("12:00");
        $_13 =strtotime("13:00");
        $_14 =strtotime("14:00");
        $_15 =strtotime("15:00");
        $_16 =strtotime("16:00");
        $_17 =strtotime("17:00");

        if($time > $_8 && $time <= $_9){
            return 1;
        }else if($time > $_9 && $time <= $_10){
            return 2;
        }else if($time > $_10 && $time <= $_11){
            return 3;
        }else if($time > $_11 && $time <= $_12){
            return 4;
        }else if($time > $_13 && $time <= $_14){
            return 5;
        }else if($time > $_14 && $time <= $_15){
            return 6;
        }else if($time > $_15 && $time <= $_16){
            return 7;
        }else if($time > $_16 && $time <= $_17){

        }
    }

if(!function_exists("getSchoolYear")){
    function getSchoolYear()
    {
        return "2018-2019";
    }
}

if(!function_exists("getPreviousSchoolYear")){
    function getPreviousSchoolYear()
    {
        return "2017-2018";
    }
}

if(!function_exists("dateFormat")){
    function dateFormat($date)
    {
        $date = date_create($date);
        return date_format($date,"Y-m-d");
    }
}

if(!function_exists("getMiddleInitial")){
    function getMiddleInitial($string)
    {
        $count = strlen($string);
        return  strtoupper(substr($string, $count * -1,1));
    }
}

if(!function_exists("getStudentStatus")){
    function getStudentStatus($id){
        return $id ? 'Enrolled' : 'Need confirmation';
    }
}

if(!function_exists("getStoragePath")){
    function getStoragePath(){
        return storage_path().'/app/public';
    }
}

if(!function_exists("getQuarterName")){
    function getQuarterName($int){
       if($int == 1){
         return 'First Quarter';
       }elseif($int == 2){
         return 'Second Quarter';
       }elseif($int == 3){
         return 'Third Quarter';
       }elseif($int == 4){
         return 'Fourth Quarter';
       }
    }
}

if(!function_exists("generateStudentNumber")){
    function generateStudentNumber($year,$id){
      if($year == 1){
        $id_len = strlen((string)$id); 
        $number = '';     
        for ($i=0; $i < (4 - $id_len); $i++) {
            $number = $number.'0';
        }
        $newId = 'A-'.$number.''.$id;

        return $newId;
      }else if($year == 2){
        $id_len = strlen((string)$id); 
        $number = '';     
        for ($i=0; $i < (4 - $id_len); $i++) {
            $number = $number.'0';
        }
        $newId = 'B-'.$number.''.$id;
        return $newId;

      }else if($year == 3){
        $id_len = strlen((string)$id); 
        $number = '';     
        for ($i=0; $i < (4 - $id_len); $i++) {
            $number = $number.'0';
        }
        $newId = 'C-'.$number.''.$id;
        return $newId;
      }else if($year == 4){
        $id_len = strlen((string)$id); 
        $number = '';     
        for ($i=0; $i < (4 - $id_len); $i++) {
            $number = $number.'0';
        }
        $newId = 'D-'.$number.''.$id;
        
        return $newId;

      }
    }
}

if(!function_exists("decodeStudentNumber")){
    function decodeStudentNumber($studentNumber){
       $str = explode("-",$studentNumber);
       $new_str = isset($str[1]) ? $str[1] : null;
       $new_sec = isset($str[0]) ? strtoupper($str[0]) : null;
       $number = strlen((string)$new_str);
       $string = (string)$new_str;

       for ($i=0; $i < $number; $i++) { 
           if(strpos($string,'0',$i+1) != false){
                $string = ltrim($string, '0');
           }else{
            break;
           }
       }

       if($new_sec == 'A'){
        $year = 0;
       }else if($new_sec == 'B'){
        $year = 1;
       }else if($new_sec == 'C'){
        $year = 2;
       }else if($new_sec == 'D'){
        $year = 3;
       }

       return [$string,$year];
    }
}

if(!function_exists("peso")){
    function peso($int)
    {
        return number_format($int,2);
    }

}
}

