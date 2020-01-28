<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DutiesController extends Controller
{
    public function index()
    {
        // 取得した年月
        $year = 2020;
        $month = 2;

        // 当月の初日
        $date = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Tokyo');

        // 当月の日数
        $daysInMonth = $date->daysInMonth;

        // 当月の初日の曜日
        $firstDayOfTheWeek = $date->dayOfWeek;
        
        // 指定された月の中の日を文字列表現で格納する配列
        $days = array();

        $weekdayMap = [
            0 => '日',
            1 => '月',
            2 => '火',
            3 => '水',
            4 => '木',
            5 => '金',
            6 => '土',
        ];

        for ($i = 0; $i < $daysInMonth; $i++) {
            // 当日の曜日（数値表現）
            $weekdayNum = ($firstDayOfTheWeek+ $i) % 7;

            // 文字列として日付・曜日を配列に追加
            array_push($days, $year."年".$month.'月'.($i + 1).'日'."(".$weekdayMap[$weekdayNum].")");
        };

        return view('DutiesController.duties', ["days" => $days]);
    }
}
