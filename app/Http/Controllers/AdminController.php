<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->get();
        return view('admin.index', compact('medicines'));
    }

    public function create()
    {
        return view('admin.medicines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'country' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'currency_code' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('medicines', 'public');
            $validated['image_path'] = $path;
        }

        Medicine::create($validated);

        return redirect()->route('admin.index')
            ->with('success', '薬の情報が正常に登録されました。');
    }

    public function destroy(Medicine $medicine)
    {
        if ($medicine->image_path) {
            Storage::disk('public')->delete($medicine->image_path);
        }
        
        $medicine->delete();
        
        return redirect()->route('admin.index')
            ->with('success', '薬の情報が削除されました。');
    }
} 