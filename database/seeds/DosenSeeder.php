<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\Dosen;
use App\User;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = Excel::load(storage_path('app/public/dosen_teknik.xlsx'))->toObject();
        // dd($results);
        // echo count($results);
        foreach($results as $data)
        {
            $dos=new Dosen;
            $dos->nip=$data->nip;
            $dos->nama=$data->nama;
            $dos->departemen_id=$data->departemen_id;
            $dos->gender=$data->gender;
            $dos->email=$data->email;
            $dos->jabatan=$data->jabatan;
            $dos->status_dosen=$data->status_ui;
            $dos->nidn=$data->nidn;
            $dos->created_at=date('Y-m-d H:i:s');
            $dos->updated_at=date('Y-m-d H:i:s');
            $dos->save();

            $user=new User;
            $user->name=$data->nama;
            $user->email=$data->email;
            $user->password=bcrypt($data->nip);
            $user->flag=1;
            $user->kat_user=2;
            $user->id_user=$dos->id;
            $user->save();
        }
    }
}
