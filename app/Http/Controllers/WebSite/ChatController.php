<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\services\PatientService;
use Illuminate\Http\Request;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function chatForm($user_id, PatientService $patientService)
    {
        $receiver = $patientService->getPatient($user_id);
        return view('chat.welcome', compact('receiver'));
    }

    public function sendMessage($user_id, Request $request, PatientService $patientService)
    {
        $patientService->sendMessage($user_id, $request->message);
    }
}