<?php

namespace App\Http\Controllers\admin;

use App\Models\MasterCity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MasterCityController extends Controller
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

        return view('admin.master_city.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $province = file_get_contents('https://api.goapi.id/v1/regional/provinsi?api_key='.ENV('PETA_KEY'));
        $data = json_decode($province) ;
        // return $data->data;
        return view('admin.master_city.add', ['provincies' => $data->data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'provinsi' => ['required', 'max:200'],
                'nama_kota' => ['required', 'max:200'],
                'pulau' => ['required', 'max:200'],
                'luar_negeri' => ['required', 'max:200'],
                'latitude' => ['required', 'max:200'],
                'longitude' => ['required', 'max:200'],
            ],
        )->validate();
        

        $insert = MasterCity::create([
            'name' => $request->nama_kota,
            'province' => $request->provinsi,
            'island' => $request->pulau,
            'overseas' => $request->luar_negeri,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($insert) {
            Alert::alert('Success', 'Berhasil menambah data.', 'success');
        }else{
            Alert::alert('Error','Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.kota.index'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterCity $masterCity)
    {
        return view('admin.master_city.edit', ['masterCity' => $masterCity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterCity $masterCity)
    {
        Validator::make(
            $request->all(),
            [
                'provinsi' => ['required', 'max:200'],
                'nama_kota' => ['required', 'max:200'],
                'pulau' => ['required', 'max:200'],
                'luar_negeri' => ['required', 'max:200'],
                'latitude' => ['required', 'max:200'],
                'longitude' => ['required', 'max:200'],
            ],
        )->validate();


        $data = [
            'name' => $request->nama_kota,
            'province' => $request->provinsi,
            'island' => $request->pulau,
            'overseas' => $request->luar_negeri,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        if ($masterCity->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.career.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterCity $masterCity)
    {
        if ($masterCity->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Kota berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Kota tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(MasterCity::latest())->make(true);
    }

    
    /**
     * Display the specified resource.
     */
    public function show( $masterCity)
    {
        $explode = explode(' ', $masterCity);   
        if ($explode[0] == "KAB." || $explode[0] == "KOTA" ) {
            $newName = '';
            unset($explode[0]); 
            if ($explode[1] == "ADM.") {
                unset($explode[1]); 
            }
            foreach ($explode as $ex) {
                $newName .= $ex.' ';
            }
        }else{
            $newName = $masterCity;
        }

        $new = strtolower($newName);
        $new = str_replace('kep.', 'kepulauan', $new);
        // return $new;
        $get = file_get_contents('https://api.goapi.id/v1/places?search='.$new.'&api_key='.ENV('PETA_KEY'));

        return $get;
    }
    public function provinsi()
    {
        $get = file_get_contents('https://api.goapi.id/v1/regional/provinsi?api_key='.ENV('PETA_KEY'));

        return $get;
    }
    public function kota($id)
    {
        $get = file_get_contents('https://api.goapi.id/v1/regional/kota?provinsi_id='.$id.'&api_key='.ENV('PETA_KEY'));

        return $get;
    }
    
}
