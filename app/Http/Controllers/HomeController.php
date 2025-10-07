<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured properties
        $featuredProperties = Property::with(['images', 'category', 'reviews'])
            ->active()
            ->featured()
            ->limit(12)
            ->get();

        // If no featured properties, get recent ones
        if ($featuredProperties->isEmpty()) {
            $featuredProperties = Property::with(['images', 'category', 'reviews'])
                ->active()
                ->latest()
                ->limit(12)
                ->get();
        }

        // Get all categories for filters
        $categories = Category::active()->ordered()->get();

        return view('nextbnb.home', compact('featuredProperties', 'categories'));
    }
}
