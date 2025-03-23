<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $medicines = Medicine::when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })->get();

        return view('medicines.index', compact('medicines', 'query'));
    }
}
