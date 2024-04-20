<html>

<head>
    <title>NativePHPのメモ帳</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="p-5">
        @yield("content")
    </div>
    @yield("script")
</body>

</html>