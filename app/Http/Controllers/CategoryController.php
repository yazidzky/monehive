<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $type = 'expense';
        if ($request->filled('type') && in_array($request->input('type'), ['income', 'expense'], true)) {
            $type = $request->input('type');
        }

        Category::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'type' => $type,
        ]);

        return back()->with('status', 'Category ditambahkan');
    }
}
