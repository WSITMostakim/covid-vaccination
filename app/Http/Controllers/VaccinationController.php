<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Vaccination;
use App\Services\VaccinationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = DB::table('centers')->select('id', 'name')->get();
        return view('registration', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, VaccinationService $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'nid' => 'required|string|min:6|unique:vaccinations,nid',
            'center' => 'required|exists:centers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validated = $request->only(['name', 'email', 'nid', 'center']);
        try {
            $result = $service->createVaccination($validated);

            if ($result['status'] === 200) {
                return redirect()->route('home')->with('success', $result['message']);
            } else {
                return redirect()->back()->with('error', $result['message'])->withInput();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $record = null;
        if ($request->filled('nid')) {
            $record = Vaccination::where('nid', $request->nid)->first();
        }

        return view('search', [
            'record' => $record,
            'nid' => $request->nid,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
