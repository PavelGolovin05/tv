<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Telecasts;
use App\TvChannels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TelecastsController extends Controller
{
    public function allTelecastsAction()
    {
        $dayOfWeekConverter = [
            0 => 'Воскресенье',
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда' ,
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота'
        ];

        $monthsConverter = [
            1 => "января",
            2 => "февраля",
            3 => "марта",
            4 => "апреля",
            5 => "мая",
            6 => "июня",
            7 => "июля",
            8 => "августа",
            9 => "сентября",
            10 => "октября",
            11 => "ноября",
            12 => "декабря"
        ];

        $date = Carbon::now();
        $dayOfWeek = $dayOfWeekConverter[$date->dayOfWeek];
        $day = $date->day;
        $month = $date->month;
        $date =  $dayOfWeek . ',' .$day . ' ' . $monthsConverter[$month];

        $teleprogramms = Telecasts::join('age_rating','age_rating.id','=','telecasts.age_rating_id')
            ->join('telecast_show','telecast_show.telecast_id','=','telecasts.id')
            ->join('categories','categories.id','=','telecasts.category_id')
            ->join('tv_channels','tv_channels.id','=','telecasts.channel_id')
            ->join('telecast_staff', 'telecast_staff.telecast_id', 'telecasts.id')
            ->join('staff','staff.id', 'telecast_staff.staff_id')
            ->join('positions', 'positions.id', 'staff.position_id')
            ->whereDay('telecast_show.show_start',$day - 3)
            ->whereMonth('telecast_show.show_start', $month)
            ->select('tv_channels.id','tv_channels.name as channel','telecasts.name','age_rating.name as age_rating','categories.name as category',
                'telecast_show.show_start','telecast_show.show_end', 'staff.FIO', 'positions.name as position')
            ->get();
        $result = [];
        $result2 = [];

        foreach ($teleprogramms as $teleprogramm) {
            $tmp = Carbon::create($teleprogramm->show_start);
            $teleprogramm->hoursMinutesStart = $tmp->format('H:i');
            $tmp = Carbon::create($teleprogramm->show_end);
            $teleprogramm->hoursMinutesEnd = $tmp->format('H:i');
            if (!key_exists($teleprogramm->channel, $result)) {
                $result[$teleprogramm->channel] = [];
            }
            if(!@key_exists($teleprogramm->name ,$result2[$teleprogramm->channel])) {
                $result[$teleprogramm->channel][] = $teleprogramm;
            }
            $result2[$teleprogramm->channel][$teleprogramm->name][] = [$teleprogramm->position => $teleprogramm->FIO];
        }
        foreach ($result as &$item) {
            foreach ($teleprogramms as &$teleprogramm) {
                $teleprogramm->staff = $result2[$teleprogramm->channel][$teleprogramm->name];
            }
        }

        return view('allTelecasts', compact('date', 'result'));
    }

    public function findTelecastsAction(Request $request)
    {
        $name = $request->get('FIO');
        $dayOfWeekConverter = [
            0 => 'Воскресенье',
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда' ,
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота'
        ];

        $monthsConverter = [
            1 => "января",
            2 => "февраля",
            3 => "марта",
            4 => "апреля",
            5 => "мая",
            6 => "июня",
            7 => "июля",
            8 => "августа",
            9 => "сентября",
            10 => "октября",
            11 => "ноября",
            12 => "декабря"
        ];

        $date = Carbon::now();
        $dayOfWeek = $dayOfWeekConverter[$date->dayOfWeek];
        $day = $date->day;
        $month = $date->month;
        $date =  $dayOfWeek . ',' .$day . ' ' . $monthsConverter[$month];

        $teleprogramms = Telecasts::join('age_rating','age_rating.id','=','telecasts.age_rating_id')
            ->join('telecast_show','telecast_show.telecast_id','=','telecasts.id')
            ->join('categories','categories.id','=','telecasts.category_id')
            ->join('telecast_staff','telecast_staff.telecast_id','telecasts.id')
            ->join('staff','staff.id','telecast_staff.staff_id')
            ->join('positions','positions.id','staff.position_id')
            ->join('tv_channels', 'tv_channels.id', 'telecasts.channel_id')
            ->where('staff.FIO', 'LIKE', "%$name%")
            ->whereDay('telecast_show.show_start',$day-3)
            ->whereMonth('telecast_show.show_start', $month)
            ->select('tv_channels.name as channel',  'staff.FIO','positions.name as position','telecasts.name','age_rating.name as age_rating',
                'categories.name as category','telecast_show.show_start','telecast_show.show_end')
            ->get();

        if($teleprogramms->count() > 0) {
            $result = [];
            $result2 = [];

            foreach ($teleprogramms as $teleprogramm) {
                $tmp = Carbon::create($teleprogramm->show_start);
                $teleprogramm->hoursMinutesStart = $tmp->format('H:i');
                $tmp = Carbon::create($teleprogramm->show_end);
                $teleprogramm->hoursMinutesEnd = $tmp->format('H:i');
                if (!key_exists($teleprogramm->channel, $result)) {
                    $result[$teleprogramm->channel] = [];
                }
                if(!@key_exists($teleprogramm->name ,$result2[$teleprogramm->channel])) {
                    $result[$teleprogramm->channel][] = $teleprogramm;
                }
                $result2[$teleprogramm->channel][$teleprogramm->name][] = [$teleprogramm->position => $teleprogramm->FIO];
            }
            foreach ($result as &$item) {
                foreach ($teleprogramms as &$teleprogramm) {
                    $teleprogramm->staff = $result2[$teleprogramm->channel][$teleprogramm->name];
                }
            }
        }
        else {
            return redirect()->back()->with('message', 'Нету программы с таким человеком!');
        }

        return view('allTelecasts', compact('date', 'result'));
    }
}
