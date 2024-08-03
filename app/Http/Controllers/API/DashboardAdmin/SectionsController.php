<?php

namespace App\Http\Controllers\API\DashboardAdmin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\SectionTranslation;
use App\Http\Resources\SectionResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class SectionsController extends Controller
{
    use ApiTrait;


    public function show(Request $request)
    {
        $this->authorize('viewAny', Section::class);

        $sectionTranslations = SectionTranslation::where('locale', $request->lang)->get();

        $sectionIds = $sectionTranslations->pluck('section_id');

        $sections = Section::whereIn('id', $sectionIds)->get();

        if (!$sections) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($sections);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Section::class);

        try {
            $section = Section::create($request->validate([
                'name' => 'required|max:30',
            ]));
            return $this->returnSuccessMessage(201, 'created successfully!');
        } catch (Exception $e) {
            return $this->returnError(500, 'Failed to create section: ' . $e->getMessage());
        }

    }




    /*   public function index(Request $request)
       {
           $section = Section::all();
           return SectionResource::collection($section);
       }

       public function show(Request $request)
       {
           $section = Section::all();
           if (!$section) {
               return response()->json('Product not found', 404);
           }

           return new SectionResource($section);
       }
       */
}