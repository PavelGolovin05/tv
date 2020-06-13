<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Countries;
use App\Telecasts;
use App\TvChannels;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TvChannelsController extends Controller
{
    public function  allChannelsAction()
    {
        $countries = Countries::all();
        $categories = Categories::where('is_channel_type', 1)->get();
        $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
            ->join('categories','categories.id','=','tv_channels.category_id')
            ->where('categories.is_channel_type',1)
            ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')
            ->paginate(3);
        return view('channels.allChannels', compact('channels','countries','categories'));
    }
    public function chosenChannelAction($name)
    {
        $teleprogramms = Telecasts::join('age_rating','age_rating.id','=','telecasts.age_rating_id')
            ->join('telecast_show','telecast_show.telecast_id','=','telecasts.id')
            ->join('categories','categories.id','=','telecasts.category_id')
            ->join('tv_channels','tv_channels.id','=','telecasts.channel_id')
            ->where('tv_channels.name',$name)
            ->select('telecasts.name','categories.name as category','age_rating.name as age_rating','telecast_show.show_start','telecast_show.show_end')
            ->get();

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
        $result = [];

        foreach ($teleprogramms as $teleprogramm) {
            $tmp = Carbon::create($teleprogramm->show_start);
            $dayOfWeek = $tmp->dayOfWeek;
            $dayOfWeek = $dayOfWeekConverter[$dayOfWeek];
            $day = $tmp->day;
            $month = $tmp->month;
            $month = $monthsConverter[$month];
            $dayOfWeek .= " ," . $day . " " . $month;
            $teleprogramm->hoursMinutesStart = $tmp->format('H:i');
            $tmp = Carbon::create($teleprogramm->show_end);
            $teleprogramm->hoursMinutesEnd = $tmp->format('H:i');

            if (!key_exists($dayOfWeek, $result)) {
                $result[$dayOfWeek] = [];
            }

            $result[$dayOfWeek][] = $teleprogramm;
        }

        $channel = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
            ->join('categories','categories.id','=','tv_channels.category_id')
            ->where('tv_channels.name',$name)
            ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')
            ->first();

        return view('channels.chosenChannel', compact('result', 'channel'));
    }

    public function findChannelAction(Request $request)
    {
        $category = $request->get('category');
        $country = $request->get('country');
        $name = $request->get('name');

        $channels = TvChannels::where('tv_channels.name',$name)->get();

        $countries = Countries::all();

        $categories = Categories::where('is_channel_type', 1)->get();


        if($category == 0 && $country == 0 && strlen($name) == 0){
            return redirect()->back()->with('message', 'Вы ничего не выбрали!');
        }

        if($category > 0 && $country == 0 && strlen($name) == 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.category_id',$category)
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }

        if($category == 0 && $country > 0 && strlen($name) == 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.country_id', $country)
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }

        if($category > 0 && $country > 0 && strlen($name) == 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.country_id', $country)
                ->where('tv_channels.category_id', $category)
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }

        if($category == 0 && $country == 0 && strlen($name) > 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.name', 'LIKE', "%$name%")
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }

        if($category > 0 && $country == 0 && strlen($name) > 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.category_id',$category)
                ->where('tv_channels.name', 'LIKE', "%$name%")
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }

        if($category == 0 && $country > 0 && strlen($name) > 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.country_id',$country)
                ->where('tv_channels.name', 'LIKE', "%$name%")
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);

        }

        if($category > 0 && $country > 0 && strlen($name) > 0){
            $channels = TvChannels::join('countries','countries.id','=','tv_channels.country_id')
                ->join('categories','categories.id','=','tv_channels.category_id')
                ->where('categories.is_channel_type',1)
                ->where('tv_channels.category_id',$category)
                ->where('tv_channels.country_id',$country)
                ->where('tv_channels.name', 'LIKE', "%$name%")
                ->select('tv_channels.id', 'tv_channels.name','tv_channels.photo_link','tv_channels.description','countries.name as country', 'categories.name as category')->paginate(3);
        }
        if ($channels == null) {
            return redirect()->back()->with('message', 'Нету каналов по заданным критериям!');
        }

        return view('channels.allChannels', compact('channels','countries','categories'));
    }
}
