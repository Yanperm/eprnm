<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method($var = '')
    {
        return $var."12356789";
    }   
}

if ( ! function_exists('dateFormatThai'))
{
    function dateFormatThai($date)
    {
        // $dateThai = "";
        // $dateBefore = explode('-', string($date));
        
        
        // $date1 = DateTime::createFromFormat('Y-m-d', "28/07/2016");
        // $date2 = $date1->format('Y-m-d');
        
       // $_firstDate = date("m-d-Y", strtotime($date)); 
        //$month = date("M",$newformat);
        //$dateThai = $date;

        return $date;
    }   
}