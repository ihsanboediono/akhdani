<?php

namespace App\Http\Controllers\Admin;


use App\Models\MasterCity;
use Illuminate\Http\Request;
use App\Models\OfficialTravel;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class OfficialTravelController extends Controller
{
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
        
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.official_travel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masters= MasterCity::all();
        return view('admin.official_travel.add', ['masters' => $masters]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'tanggal_berangkat' => ['required', 'max:200'],
                'tanggal_pulang' => ['required', 'max:200'],
                'kota_asal' => ['required', 'max:200'],
                'kota_tujuan' => ['required', 'max:200'],
                'keterangan' => ['required'],
            ],
        )->validate();
        
        $date1 = strtotime($request->tanggal_berangkat);
        $date2 = strtotime($request->tanggal_pulang);
        $diff = $date2 - $date1;
        $days = floor($diff / (60 * 60 * 24));
        $days = $days+1;


        $insert = OfficialTravel::create([
            'user_id' => auth()->user()->id,
            'departure_date' => $request->tanggal_berangkat,
            'return_date' => $request->tanggal_pulang,
            'hometown_id' => $request->kota_asal,
            'destination_id' => $request->kota_tujuan,
            'duration' => $days,
            'status' => 'pending',
            'description' => $request->keterangan,
        ]);

        if ($insert) {
            Alert::alert('Success', 'Berhasil menambah data.', 'success');
        }else{
            Alert::alert('Error','Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.perdin.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficialTravel $officialTravel)
    {
        $masters= MasterCity::all();
        $officialTravel->load(['hometown', 'destination'])->get();

        // return $officialTravel;
        $jarak = round($this->distance($officialTravel->hometown->latitude, $officialTravel->hometown->longitude, $officialTravel->destination->latitude, $officialTravel->destination->longitude, "K"));

        if ($jarak > 60) {
            if (strtolower($officialTravel->hometown->province) == strtolower($officialTravel->destination->province) && strtolower($officialTravel->hometown->island) == strtolower($officialTravel->destination->island)) {
                $uang = 200000;
                $ukur = 'jarak > 60km';
            }
            if (strtolower($officialTravel->hometown->province) != strtolower($officialTravel->destination->province) && strtolower($officialTravel->hometown->island) == strtolower($officialTravel->destination->island)) {
                $uang = 250000;
                $ukur = 'jarak > 60km';
            }
            if (strtolower($officialTravel->hometown->province) != strtolower($officialTravel->destination->province) && strtolower($officialTravel->hometown->island) != strtolower($officialTravel->destination->island )) {
                $uang = 300000;
                $ukur = 'jarak > 60km';
            }
            if (  $officialTravel->destination->overseas == true || $officialTravel->hometown->overseas == true) {
                $uang = 750000;
                $ukur = 'jarak > 60km';
            }
        }else{
            $uang = 0;
            $ukur = 'jarak < 60km';
        }
        $value = (int)$officialTravel->duration * $uang;
        $total = number_format($value, 0, ',', '.');
        $uang = number_format($uang, 0, ',', '.');

        return view('admin.official_travel.approval', ['officialTravel' => $officialTravel, 'masters' => $masters, 'distance' => $jarak, 'total' => $total, 'uang' => $uang, 'ukur' => $ukur]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficialTravel $officialTravel)
    {
        return view('admin.official_travel.edit', ['officialTravel' => $officialTravel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function approve(Request $request, OfficialTravel $officialTravel)
    {
        
        $data = [
            'status' => 'approved',
        ];

        if ($officialTravel->update($data)) {
            Alert::alert('Success', 'Perdin Berhasil Di Setujui.', 'success');
        }else{
            Alert::alert('Error', 'Perdin Gagal Di Setujui.', 'error');
        }
        return redirect()->to(route('admin.perdin.index'));
    }

    public function reject(Request $request, OfficialTravel $officialTravel)
    {
        
        $data = [
            'status' => 'rejected',
        ];

        if ($officialTravel->update($data)) {
            Alert::alert('Success', 'Perdin Berhasil Di Tolak.', 'success');
        }else{
            Alert::alert('Error', 'Perdin Gagal Di Tolak.', 'error');
        }
        return redirect()->to(route('admin.perdin.index'));
    }


    public function history()
    {
        return view('admin.official_travel.history');
    }

    public function data()
    {
        return DataTables::of(OfficialTravel::whereIn('status', ['pending'])->with(['hometown', 'destination', 'user'])->latest())->make(true);
    }
    public function history_data()
    {
        return DataTables::of(OfficialTravel::whereNotIn('status', ['pending'])->with(['hometown', 'destination', 'user'])->latest())->make(true);
    }
}
