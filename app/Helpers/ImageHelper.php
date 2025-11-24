<?php

if (! function_exists('bookImage')) {
    function bookImage($path)
    {
        return $path && file_exists(public_path('storage/'.$path))
            ? asset('storage/'.$path)
            : asset('images/buku.png');
    }
}
