<?php
namespace App\services;

use App\Events\ChatEvent;
use App\Models\Messages;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientService
{
    public function getPatient($user_id)
    {
        return Patient::where('id', $user_id)->first();
    }

    public function sendMessage($user_id, $message)
    {
        $data['sender'] = Auth::user()->id;
        $data['receiver'] = $user_id;
        $data['message'] = $message;
        Messages::create($data);
        $receiver = $this->getPatient($user_id);
        \broadcast(new ChatEvent($receiver, $message));
    }
}