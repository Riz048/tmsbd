<?php

if (! function_exists('bookImage')) {
    function bookImage($path)
    {
        // Jika null → fallback
        if (!$path) {
            return asset('images/buku.png');
        }

        // Jika isinya URL (http / https)
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Jika file ada di storage/app/public
        if (file_exists(public_path('storage/'.$path))) {
            return asset('storage/'.$path);
        }

        // Jika file ada di public/images
        if (file_exists(public_path('images/'.$path))) {
            return asset('images/'.$path);
        }

        // Jika semua gagal → fallback
        return asset('images/buku.png');
    }
}
