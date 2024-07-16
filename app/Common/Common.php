<?php

if (! function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        try {
            if (! $date) {
                return $date;
            }

            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
        } catch (\Exception $e) {
            $date = date($format, strtotime($date));
        }

        return $date;
    }
}

if (! function_exists('getConst')) {
    function getConst($key = '', $defaultValue = '')
    {
        return config('const.'.$key, $defaultValue);
    }
}

function timeAgo($timestamp)
{
    $time = time() - strtotime($timestamp);

    if ($time < 1) {
        return 'Vừa xong';
    }

    $tokens = [
        31536000 => 'năm',
        2592000 => 'tháng',
        604800 => 'tuần',
        86400 => 'ngày',
        3600 => 'giờ',
        60 => 'phút',
        1 => 'giây',
    ];

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) {
            continue;
        }
        $numberOfUnits = floor($time / $unit);

        return $numberOfUnits.' '.$text.' trước';
    }
}
