<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    // Получение списка новостей с кэшированием на 1 час
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $cacheKey = "news.page.{$page}.per_page.{$perPage}";

        $news = Cache::remember($cacheKey, 3600, function () use ($perPage) {
            return News::latest()->paginate($perPage);
        });

        return response()->json([
            'data' => $news->items(),
            'current_page' => $news->currentPage(),
            'last_page' => $news->lastPage(),
            'per_page' => $news->perPage(),
            'total' => $news->total(),
        ]);
    }

    // Добавление новости и сброс кэша
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
        ]);

        $news = News::create($validated);

        // Сброс кэша новостей
        $this->clearNewsCache();

        return response()->json($news, 201);
    }

    // Метод для сброса кэша с ключами новостей
    protected function clearNewsCache()
    {
        $redis = Cache::getRedis();

        // Получаем ключи по шаблону (если Redis поддерживает KEYS)
        $keys = $redis->keys('news.page.*');

        foreach ($keys as $key) {
            $redis->del($key);
        }
    }
}
