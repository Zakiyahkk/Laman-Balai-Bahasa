<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AAkuntabilitasController extends Controller
{
    public function renstra()
    {
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.renstra', compact('akuntabilitasOpen'));
    }

    public function dipa() 
    { 
        $akuntabilitasOpen = true; 
        return view('admin.akuntabilitas.dipa', compact('akuntabilitasOpen')); 
    }

   public function pk() { 
    return view('admin.akuntabilitas.perjanjian-kinerja', ['akuntabilitasOpen' => true]); 
}

    public function ra() { 
     return view('admin.akuntabilitas.rencana-aksi', ['akuntabilitasOpen' => true]); 
    }

    public function lakin() { 
       return view('admin.akuntabilitas.lakin.index', ['akuntabilitasOpen' => true ]);
    }

    public function sakai() { 
        return view('admin.akuntabilitas.sakai', ['akuntabilitasOpen' => true]); 
    } 
}