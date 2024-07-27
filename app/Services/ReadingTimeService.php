<?php

namespace App\Services;

class ReadingTimeService
{
    public function calculateReadingTime($text)
    {
        $totalWords = str_word_count($text);

        $minutesToRead = round($totalWords / 200);

        return (int) max(1, $minutesToRead);
    }
}
