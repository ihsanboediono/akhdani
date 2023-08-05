<?php

namespace Database\Seeders;

use App\Models\MasterCity;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins=[
            [
                'name'=>'Super Admin',
                'username'=>'superadmin',
                'email'=>'superadmin@example.com',
                'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin'=>1,
                'is_active'=>1,
                'role'=>'root',
                'password'=>Hash::make('Password'),
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Admin SDM',
                'username'=>'adminsdm',
                'email'=>'adminsdm@gmail.com',
                'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin'=>0,
                'is_active'=>1,
                'role'=>'devisi-sdm',
                'password'=>Hash::make('Password'),
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Pegawai',
                'username'=>'pegawai',
                'email'=>'pegawai@gmail.com',
                'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin'=>0,
                'is_active'=>1,
                'role'=>'pegawai',
                'password'=>Hash::make('Password'),
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        User::insert($admins);

        $cities = [
            [
                'name'=>'Solo',
                'province'=>'Jawa Tengah',
                'island'=>'Jawa',
                'overseas'=>0,
                'latitude'=>'-7.56925',
                'longitude'=>'110.82845',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Yogyakarta',
                'province'=>'Jawa Tengah',
                'island'=>'Jawa',
                'overseas'=>0,
                'latitude'=>'-7.97784',
                'longitude'=>'110.36723',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Malang',
                'province'=>'Jawa Timur',
                'island'=>'Jawa',
                'overseas'=>0,
                'latitude'=>'-7.97712',
                'longitude'=>'112.63403',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        MasterCity::insert($cities);
    }
}
