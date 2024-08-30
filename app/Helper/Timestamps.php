<?php namespace App\Helper;

trait Timestamps{

    public function normal_access($date){
        if (empty($date) or $date == '0000-00-00 00:00:00') {
            return null;
        }
        $datetime = jDateTime::datetimeToArray($date, "-");
        return jDateTime::toJalaliStr($datetime, "Y/m/d");
    }
    public function normal_access_birthday($date){
        if (empty($date) or $date == '0000-00-00 00:00:00') {
            return null;
        }

//        $fa_now = \Morilog\Jalali\Facades\jDateTime::strftime('Y/m/d H:i:s', $date);
//        return $fa_now;

        $datetime = jDateTime::datetimeToArray($date, "-");
        return jDateTime::toJalaliStr($datetime, "Y/m/d");
    }
    public function normal_access_time($date){
        if (empty($date) or $date == '0000-00-00 00:00:00') {
            return null;
        }

        $fa_now = \Morilog\Jalali\Facades\jDateTime::strftime('Y/m/d H:i:s', $date);
        return $fa_now;
    }
    public function normal_modify($value, $field_name){
        if(!$value){
            $this->attributes[$field_name] = null;
        }else{
            $datetime = jDateTime::datetimeToArray($value,'/');
            $this->attributes[$field_name] = jDateTime::toGregorianStr($datetime,"Y-m-d");
        }
    }

    public function getCreatedAtAttribute($date)
    { // get as jalali
        return $this->normal_access_time($date);
    }

    public function getUpdatedAtAttribute($date)
    { // get as jalali
        return $this->normal_access_time($date);
    }
    public function getPaymentDateAttribute($date)
    { // get as jalali
        return $this->normal_access_time($date);
    }

    public function getDeletedAtAttribute($date)
    { // get as jalali
        return $this->normal_access_time($date);
    }
    public function getLadderAtAttribute($date)
    { // get as jalali
        if(!is_null($date))
            return jDateTime::strftime('Y-m-d H:i:s', $date);
        else
            return '';
    }
}