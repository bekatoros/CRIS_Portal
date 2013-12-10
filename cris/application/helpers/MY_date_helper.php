<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('convert_date_to_str'))
{
    function convert_date_to_str($time = '')
    {
        if(strlen($time) == 0)
        {
            $time = now();
        }
        
        return date('YmdHis',$time);
    }
}

if( ! function_exists('convert_str_to_date'))
{
    function convert_str_to_date($str = '')
    {
        if(strlen($str) != 14)
        {
            return new DateTime();
        }
        else
        {
            return date_create_from_format('YmdHis', $str);
        }
    }
}

if( ! function_exists('convert_str_to_date_for_date_picker'))
{
    
    function convert_str_to_date_for_date_picker($str = '')
    {
       
            $date = date_create_from_format('Ymd', $str);
            return date_format($date,'d-m-Y');
       
    }
}
if( ! function_exists('convert_str_to_time_for_time_picker'))
{
    
    function convert_str_to_time_for_time_picker($str = '')
    {
        if(strlen($str) == 6)
        {
            return $str[0].$str[1].":".$str[3].$str[4];
        }
        else 
        {
            return new DateTime();
        }
    }
}
if( ! function_exists('convert_datepicker_to_str'))
{
    function convert_datepicker_to_str($str = '')
    {
        $date = new DateTime();
        
        if(strlen($str) == 10) //date is d/m/Y
        {
            $date = date_create_from_format('d-m-Y', $str);
        }
        
        return date_format($date,'Ymd');
    }
}

if( ! function_exists('convert_timepicker_to_str'))
{
    function convert_timepicker_to_str($str = '')
    {
        if(strlen($str) == 5) //time is hh:ss
        {
            return $str[0].$str[1].$str[3].$str[4]."00";
        }
        else
        {
            return "000000";
        }
        
    }
}