<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\PatientTranslation;
use App\Models\Patient;

use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function show($id, Request $request)
    {
        $patient = PatientTranslation::where('locale', $request->lang)->where('patient_id', $id)->pluck('patient_id')->first();
        $patient = Patient::find($patient);

        if (!$patient) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($patient);
    }
}