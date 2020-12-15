<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Home | Codeigniter"
        ];
        return view('pages/index', $data);
    }

    public function about()
    {
        // $data = [
        //     'title' => "Home | Codeigniter"
        // ];
        // return view('pages/index', $data);
        echo "masuk";
    }
}
