<?php

namespace Qtvhao\LearningModule\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LearningController extends Controller
{
    public function listArticles()
    {
        // Ví dụ: Lấy danh sách bài viết từ database
        return response()->json([
            'articles' => [
                ['id' => 1, 'title' => 'Article 1'],
                ['id' => 2, 'title' => 'Article 2'],
            ]
        ]);
    }

    public function listVideos()
    {
        // Ví dụ: Lấy danh sách video từ database
        return response()->json([
            'videos' => [
                ['id' => 1, 'title' => 'Video 1'],
                ['id' => 2, 'title' => 'Video 2'],
            ]
        ]);
    }
}
