<?php

namespace Core\Middleware;

class Middleware {
    const MAP = [
        'Guest' => Guest::class,
        'Auth' => Auth::class,
    ];
}