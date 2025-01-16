<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    public static function getDoctorTitle(){
       return [1=>'Professor',2=>'Associate Professor',3=>'Senior Consultant',4=>'Assistant Professor',5=>'Junior Consultant',6=>'Postgraduate Dr.',7=>'Doctor'];
    }
}
