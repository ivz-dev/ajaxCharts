<?php
$dsn = 'mysql:host=localhost; dbname=smart_hive';
$user = 'root';
$password = '123';
$dbh = new PDO($dsn, $user, $password);


if(!empty($_GET['type']) && !empty($_GET['date1']) && !empty($_GET['date2']))
{
    $type = $_GET['type'];
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];

    switch ($type){
        case "temp":
            $select = $dbh->prepare("SELECT `temp`, `date` FROM `sensors` WHERE `date`>=:date1 && `date`<=:date2");
            $select->bindParam(":date1", $date1);
            $select->bindParam(":date2", $date2);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);

            $returnArr = [];

            foreach ($result as $item)
            {
                $date = explode(" ",$item['date'])[0];
                $year = explode("-",$date)[0];
                $month = explode("-",$date)[1];
                $day = explode("-",$date)[2];
                $val = $item['temp'];

                $returnArr[] = array("year"=>$year, "month"=>$month, "day"=>$day, "val"=>$val);
            }

            echo json_encode($returnArr);
            break;
        case "humidity":
            $select = $dbh->prepare("SELECT `humidity`, `date` FROM `sensors` WHERE `date`>=:date1 && `date`<=:date2");
            $select->bindParam(":date1", $date1);
            $select->bindParam(":date2", $date2);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            break;
        case "weight":
            $select = $dbh->prepare("SELECT `weight`, `date` FROM `sensors` WHERE `date`>=:date1 && `date`<=:date2");
            $select->bindParam(":date1", $date1);
            $select->bindParam(":date2", $date2);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            break;
        case "pressure":
            $select = $dbh->prepare("SELECT `pressure`, `date` FROM `sensors` WHERE `date`>=:date1 && `date`<=:date2");
            $select->bindParam(":date1", $date1);
            $select->bindParam(":date2", $date2);
            $select->execute();
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            break;

    }







}


