<?php

namespace App\Http\Controllers\WebSite;

use App\Models\Doctor;
use App\Models\Section;
use App\Models\Service;
use App\Models\Group;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Jobs\PrintHelloJob;
use Illuminate\Support\Facades\Crypt;


class WelcomeController extends Controller
{


    public function CallComponent()
    {
        $id = null;
        return view('livewire.ShowDoctorTable.index', compact('id'));

    }

    public function ShowServices()
    {
        $groups = Group::all();
        $services = Service::all();
        return view('WebSite.ShowServices.show_services', compact('groups', 'services'));
    }

    public function ShowDoctors()
    {

        $doctors = Doctor::get();
        return view('WebSite.ShowDoctors.show_doctors', compact('doctors'));
    }

    public function ShowSections()
    {

        //   /Illuminate\Support\Facades\Queue::push(new PrintHelloJob());
        $sections = Section::all();
        return view('WebSite.ShowSections.show_sections', compact('sections'));
    }


}