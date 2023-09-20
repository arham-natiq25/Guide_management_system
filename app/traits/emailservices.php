<?php

namespace App\Traits;

trait EmailServices
{
    function CusKey($emailTemplet,$res,$password) {

        $emailBody = str_replace(['[customer_name]','[resort_name]','[lenght_of_trip]','[trip_date]','[guide_name]','[guide_phone]','[total]','[password]'],[$res->fname.' '.$res->lname , $res->location->location_name,
        $res->trip->length, $res->date,$res->guide->fname.' '.$res->guide->lname,$res->guide->mobile,$res->total_fee,$password ],$emailTemplet->notes);
        return $emailBody;
    }

    function GuideKey($emailTemplet,$res) {
        $guideBody = str_replace(['[guide]','[trip_name]','[customer_name]','[customer_contact]',
        '[customer_email]','[date]','[location]','[time]'],
        [$res->guide->fname.' '.$res->guide->lname, $res->trip->trip_name, $res->fname.' '.$res->lname , $res->phone ,
         $res->user->email , $res->date , $res->location->location_name , $res->trip->start_time
        ],$emailTemplet->notes);

        return $guideBody;
    }

}
