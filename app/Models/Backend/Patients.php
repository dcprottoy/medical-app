<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Patients extends Model
{
    use HasFactory;


        protected $fillable = [
            'name',
            'patient_id',
            'contact_no',
            'emr_cont_no',
            'address',
            'birth_date',
            'year',
            'month',
            'day',
            'sex'
        ];

        protected $appends = [
            'age','da'
        ];
        public function getAgeAttribute(){

            $date = Carbon::now();
            $ageY = $date->diffInYears(Carbon::parse($this->birth_date));
            $date2 = $date->copy()->subYears($ageY);
            $ageM = $date2->diffInMonths(Carbon::parse($this->birth_date));
            $date3 = $date2->copy()->subMonths($ageM);
            $ageD = $date3->diffInDays(Carbon::parse($this->birth_date));
            return $ageY."Y-".$ageM."M-".$ageD."D";
        }
        public function getDaAttribute(){

            $date = Carbon::now();
            $ageY = $date->diffInYears(Carbon::parse($this->birth_date));
            $date2 = $date->copy()->subYears($ageY);
            $ageM = $date2->diffInMonths(Carbon::parse($this->birth_date));
            $date3 = $date2->copy()->subMonths($ageM);
            $ageD = $date3->diffInDays(Carbon::parse($this->birth_date));
            return ['year'=>$ageY,'month'=>$ageM,'day'=>$ageD];
        }


}
