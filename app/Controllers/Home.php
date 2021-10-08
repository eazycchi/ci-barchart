<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data =[
            'judul' => 'BPS Provinsi Lampung - Barchart Generator',
        ];

        return view('landingPage/barchart', $data);
    }

    public function linechart()
    {
        $data =[
            'judul' => 'BPS Provinsi Lampung - Grafik Garis',
        ];

        return view('landingPage/linechart', $data);
    }
}
