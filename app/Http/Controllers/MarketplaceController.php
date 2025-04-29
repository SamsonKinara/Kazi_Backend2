<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;

class MarketplaceController extends Controller
{
    public function createJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $job = Job::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ]);

        return response()->json(['success' => true, 'job' => $job]);
    }

    public function getJobs(Request $request)
    {
        $jobs = Job::with('category')->paginate(10);
        return response()->json($jobs);
    }

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getJob($id)
    {
        $job = Job::with('category')->find($id);
        if ($job) {
            return response()->json($job);
        }

        return response()->json(['error' => 'Job not found'], 404);
    }
}
