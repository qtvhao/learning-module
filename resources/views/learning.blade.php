@extends('layouts.app')

@section('title', 'Learning')

@section('content')
<div id="learning-app" class="max-w-2xl mx-auto bg-white p-8 border border-gray-300 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Learning Content</h2>

    <!-- Thông báo lỗi -->
    <div v-if="errorMessage" class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        @{{ errorMessage }}
        <div class="mt-4">
            <!-- Nút Đã hiểu -->
            <button class="bg-white hover:bg-gray-200 text-blue-500 font-bold py-2 px-4 rounded border border-blue-500" @click="errorMessage = ''">Đã hiểu</button>
            <!-- Nút Quản lý thiết bị -->
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="window.location.href = '/device-management'">Quản lý thiết bị</button>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    new Vue({
        el: '#learning-app',
        data: {
            articles: [],
            videos: [],
            errorMessage: ''
        },
        created() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                // Lấy token từ localStorage
                const token = localStorage.getItem('token');
                if (token) {
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    try {
                        const articlesResponse = await axios.get('/api/learning/articles');
                        this.articles = articlesResponse.data.articles;

                        const videosResponse = await axios.get('/api/learning/videos');
                        this.videos = videosResponse.data.videos;
                    } catch (error) {
                        console.error('Error fetching data:', error.response.data);
                        this.errorMessage = error.response.data;
                        if (this.errorMessage === "Vượt quá giới hạn thiết bị truy cập") {
                            console.log('Giới hạn thiết bị truy cập');
                            console.log('Hệ thống phát hiện một thiết bị trùng lặp. Vui lòng vào phần quản lý thiết bị để kiểm tra');
                            // Giới hạn thiết bị truy cập
                            // Hệ thống phát hiện một thiết bị trùng lặp. Vui lòng vào phần quản lý thiết bị để kiểm tra
                            this.errorMessage = 'Hệ thống phát hiện một thiết bị trùng lặp. Vui lòng vào phần quản lý thiết bị để kiểm tra';
                            // Đã hiểu
                            // Đã hiểu: Hệ thống giữ nguyên ở trang trước đó, không xử lý gì
                            // Quản lý thiết bị
                            // Quản lý thiết bị: Hệ thống chuyển đến tab Quản lý thiết bị
                        }
                    }
                } else {
                    this.errorMessage = 'Authorization token not found. Please log in again.';
                    setTimeout(() => window.location.href = '/login', 5_000);
                }
            }
        }
    });
</script>
@endsection