<?php

include('db.php');

$dataBase = new Database();

class Images{
    private $randomNumberForLatter;
    private $ranNumber;
    private $uid;

    private function genRandomNumberForLetter(){
        $this->randomNumberForLatter =  (string)rand(0,25);
        return $this->randomNumberForLatter;
    }

    private function genRandomNumber(){
        $this->ranNumber =  (string)rand(1000,10000);
        return $this->ranNumber;
    }

    private function genUID(){
        $letterArrayForImage = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        $letterArrayCount = count($letterArrayForImage);

        $word_1 = "";

        $word_2 = "";

        $word_3 = "";

        for($one = 0; $one < 4; $one++){
            (int)$random[$one] = $this->genRandomNumberForLetter();
            $word_1 .= (string)$letterArrayForImage[$random[$one]];
        }

        for($two = 0; $two < 4; $two++){
            (int)$random[$two] = $this->genRandomNumberForLetter();
            $word_2 .= (string)$letterArrayForImage[$random[$two]];
        }

        for($three = 0; $three < 4; $three++){
            (int)$random[$three] = $this->genRandomNumberForLetter();
            $word_3 .= (string)$letterArrayForImage[$random[$three]];
        }

        $this->uid = "uid-".$word_1."-".$word_2."-".hexdec(uniqid())."-".$word_3."-".$this->genRandomNumber();

        return $this->uid;
    }

    private function checkUidExistance(){
        $uid = $this->genUID();

        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM image WHERE uid = '$uid'";
        $result = $con->query($sql);
        $row = $result->num_rows;

        if($row <= 0){
            return $uid;
        }
        else{
            $this->checkUidExistance();
        }
    }

    public function insertImage($filePath){
        $filePath = $filePath;
        $uid =  $this->checkUidExistance();
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO image(image_url,uid) VALUES ('$filePath','$uid')";
        $result = $con->query($sql);
        return $result;
    }
}
