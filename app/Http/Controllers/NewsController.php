<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function about()
    {
        $admins = User::where('role', 'admin')->get();
        $reporters = User::where('role', 'reporter')->get();
        return view('news.about', compact('admins', 'reporters'));
    }

    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        // Pencarian
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('published_at', $request->tanggal);
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        // Sorting
        if ($request->sort == 'terlama') {
            $query->orderBy('published_at', 'asc');
        } elseif ($request->sort == 'populer') {
            $query->orderBy('views', 'desc');
        } else {
            $query->orderBy('published_at', 'desc');
        }

        $news = $query->paginate(8)->withQueryString();

        $popularNews = News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        return view('news.news-page', compact('news', 'popularNews'));
    }

    public function manage(Request $request)
    {
        $isAdmin = Auth::user()->role === 'admin';
        $baseQuery = $isAdmin ? News::query() : News::where('user_id', Auth::id());

        // Statistik
        $stat_total = (clone $baseQuery)->count();
        $stat_published = (clone $baseQuery)->where('status', 'published')->count();
        $stat_draft = (clone $baseQuery)->where('status', 'draft')->count();
        $stat_views = News::sum('views'); // total semua views (umum)

        // Query untuk tabel
        $query = $isAdmin ? News::latest() : News::where('user_id', Auth::id())->latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $news = $query->paginate(10)->withQueryString();

        return view('news.manage', compact(
            'news',
            'stat_total',
            'stat_published',
            'stat_draft',
            'stat_views'
        ));
    }

    public function create()
    {
        if (!in_array(Auth::user()->role, ['reporter', 'admin'])) {
            abort(403);
        }

        $defaultAuthor = Auth::user()->name ?? '';

        return view('news.create', compact('defaultAuthor'));
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['reporter', 'admin'])) {
            abort(403);
        }

        $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'author'   => 'nullable|string|max:255',
        ]);

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('news', 'public')
            : null;

        News::create([
            'user_id'      => Auth::id(),
            'title'        => $request->judul,
            'content'      => $request->isi,
            'image'        => $path,
            'category'     => $request->kategori,
            'status'       => 'draft',
            'published_at' => $request->tanggal,
            'author'       => $request->author ?: (Auth::user()->name ?? 'Unknown'),
            'views'        => 0, // default
        ]);

        return redirect()->route('news.manage')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'author'   => 'required|string|max:255',
        ]);

        $news->title        = $request->judul;
        $news->content      = $request->isi;
        $news->category     = $request->kategori;
        $news->published_at = $request->tanggal;
        $news->author       = $request->author;

        if ($request->hasFile('gambar')) {
            if ($news->image && file_exists(storage_path('app/public/' . $news->image))) {
                unlink(storage_path('app/public/' . $news->image));
            }
            $path = $request->file('gambar')->store('news', 'public');
            $news->image = $path;
        }

        $news->save();

        return redirect()->route('news.manage')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if (!in_array(Auth::user()->role, ['reporter', 'admin'])) {
            abort(403);
        }
        $news->delete();
        return redirect()->route('news.manage')->with('success', 'Berita berhasil dihapus!');
    }

    public function publish($id)
    {
        $news = News::findOrFail($id);
        if (!in_array(Auth::user()->role, ['reporter', 'admin'])) {
            abort(403);
        }
        $news->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
        return redirect()->route('news.manage')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);

        // Increment view dengan aman (tidak update timestamps)
        $news->timestamps = false;
        $news->increment('views');
        $news->timestamps = true;

        $popularNews = News::where('status', 'published')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('news.show', compact('news', 'popularNews'));
    }

    public function dashboard()
    {
        $latestNews = News::where('status', 'published')->latest()->take(8)->get();
        $totalViews = News::sum('views');
        $totalNews = News::count();
        $totalCategories = News::distinct('category')->whereNotNull('category')->count('category');
        // Anda bisa tambahkan $totalVisitors jika ingin statistik pengunjung unik
        return view('news.dashboard', compact('latestNews', 'totalViews', 'totalNews', 'totalCategories'));
    }
}
