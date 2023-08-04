<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialTravel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departure_date',
        'return_date',
        'hometown_id',
        'destination_id',
        'duration',
        'description',
    ];

    protected $appends = ['tanggal'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function HomeTown()
    {
        return $this->belongsTo(MasterCity::class, 'hometown_id');
    }

    public function Destination()
    {
        return $this->belongsTo(MasterCity::class, 'destination_id');
    }

    function format_indo($date){
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        
        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w",strtotime($date));
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;
    
        return $result;
    }

    public function getTanggalAttribute()
    {
        $departure = $this->format_indo($this->attributes['departure_date']);
        $return = $this->format_indo($this->attributes['return_date']);
        $dep_ex = explode(' ' , $departure);
        $ret_ex = explode(' ' , $return);
        if ($dep_ex[2] == $ret_ex[2]) {
            $depx = str_replace($dep_ex[2], '',$departure); 
        }else{
            $datx = $departure;
        }
        $result = [
            'departure' => $depx,
            'return' => $return,
        ];
        return $result;

    }
}
