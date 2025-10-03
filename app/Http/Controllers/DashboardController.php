<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $headline = News::where('status', 'published')->latest()->first();

        $popularNews = News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        $latestNews = News::where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        $carouselNews = News::where('status', 'published')
            ->latest()
            ->take(2)
            ->get();

        $excludeIds = collect();
        if ($headline) $excludeIds->push($headline->id);
        $excludeIds = $excludeIds->merge($popularNews->pluck('id'));
        $excludeIds = $excludeIds->merge($carouselNews->pluck('id'));
        $excludeIds = $excludeIds->merge($latestNews->pluck('id'));
        $excludeIds = $excludeIds->unique()->filter()->values()->all();

        $recommendNewsQuery = News::where('status', 'published');
        if (!empty($excludeIds)) {
            $recommendNewsQuery->whereNotIn('id', $excludeIds);
        }
        $recommendNews = $recommendNewsQuery->inRandomOrder()->take(6)->get();

        $totalNews       = News::count();
        $totalCategories = News::distinct('category')->count('category');
        $totalVisitors   = News::sum('views');

        return view(
            'news.dashboard',
            compact(
                'user',
                'headline',
                'popularNews',
                'latestNews',
                'carouselNews',
                'recommendNews',
                'totalNews',
                'totalCategories',
                'totalVisitors'
            )
        );
    }
}
