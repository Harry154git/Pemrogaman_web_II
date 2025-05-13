<?php

namespace App\Controllers;
use App\Models\DataModel;

class Home extends BaseController
{
    public function beranda(): string {
        $beranda = new DataModel();
        $databeranda = $beranda->getberandadata();
        return view('beranda/beranda', $databeranda);
    }

    public function profil() {
        $profil = new DataModel();
        $dataprofil = $profil->getprofildata();
        return view('profil/profil', $dataprofil);
    }
}