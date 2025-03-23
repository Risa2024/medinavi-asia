<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;
//検索フォームから送られてきたキーワードを使って、薬データを検索し、画面に表示する処理

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
