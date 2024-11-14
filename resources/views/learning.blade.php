@extends('layouts.app')

@section('title', 'Learning')

@section('content')
    <div id="learning-app" class="max-w-2xl mx-auto bg-white p-8 border border-gray-300 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Learning Content</h2>

        <!-- Danh sách Articles -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Articles</h3>
            <ul>
                <li v-for="article in articles" :key="article.id" class="mb-2">
                    <p class="text-gray-800">@{{ article.title }}</p>
                </li>
            </ul>
        </div>

        <!-- Danh sách Videos -->
        <div>
            <h3 class="text-xl font-semibold mb-2">Videos</h3>
            <ul>
                <li v-for="video in videos" :key="video.id" class="mb-2">
                    <p class="text-gray-800">@{{ video.title }}</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- Import Vue và Axios -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#learning-app',
            data: {
                articles: [],
                videos: []
            },
            created() {
                // Lấy token từ localStorage
                const token = localStorage.getItem('token');
                if (token) {
                    // Thiết lập header Authorization cho tất cả các request của Axios
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    // Gọi API để lấy danh sách articles
                    axios.get('/api/learning/articles')
                        .then(response => {
                            this.articles = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching articles:', error);
                        });

                    // Gọi API để lấy danh sách videos
                    axios.get('/api/learning/videos')
                        .then(response => {
                            this.videos = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching videos:', error);
                        });
                } else {
                    // Thông báo khi không tìm thấy token
                    window.location.href = '/login'; // Điều hướng về trang đăng nhập
                }
            }
        });
    </script>
@endsection