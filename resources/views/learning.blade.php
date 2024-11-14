@extends('layouts.app')

@section('title', 'Learning')

@section('content')
<div id="learning-app" class="max-w-2xl mx-auto bg-white p-8 border border-gray-300 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Learning Content</h2>

    <!-- Thông báo lỗi -->
    <div v-if="errorMessage" class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        @{{ errorMessage }}
    </div>

    <!-- Danh sách Articles -->
    <div class="mb-6" v-if="!errorMessage">
        <h3 class="text-xl font-semibold mb-2">Articles</h3>
        <ul>
            <li v-for="article in articles" :key="article.id" class="mb-2">
                <p class="text-gray-800">@{{ article.title }}</p>
            </li>
        </ul>
    </div>

    <!-- Danh sách Videos -->
    <div v-if="!errorMessage">
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
            videos: [],
            errorMessage: ''  // Biến để lưu thông báo lỗi
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
                        this.articles = response.data.articles;
                    })
                    .catch(error => {
                        console.error('Error fetching articles:', error.response.data);
                        this.errorMessage = error.response.data;
                    });

                // Gọi API để lấy danh sách videos
                axios.get('/api/learning/videos')
                    .then(response => {
                        this.videos = response.data.videos;
                    })
                    .catch(error => {
                        console.error('Error fetching videos:', error.response.data);
                        this.errorMessage = error.response.data;
                    });
            } else {
                // Thông báo khi không tìm thấy token
                this.errorMessage = 'Authorization token not found. Please log in again.';
                setTimeout(() => window.location.href = '/login', 5_000);  // Điều hướng về trang đăng nhập sau 2 giây
            }
        }
    });
</script>
@endsection