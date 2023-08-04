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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return OfficialTravel::latest()->with(['hometown', 'destination'])->get();
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
        return view('admin.official_travel.edit', ['officialTravel' => $officialTravel]);
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
    public function update(Request $request, OfficialTravel $officialTravel)
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

        $data = [
            'departure_date' => $request->tanggal_berangkat,
            'return_date' => $request->tanggal_pulang,
            'hometown_id' => $request->kota_asal,
            'destination_id' => $request->kota_tujuan,
            'duration' => $days,
            'description' => $request->keterangan,
        ];

        if ($officialTravel->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.perdin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficialTravel $officialTravel)
    {
        if ($officialTravel->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Perjalanan Dinas berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Perjalanan Dinas tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(OfficialTravel::latest()->with(['hometown', 'destination', 'user'])->get())->make(true);
    }
}
