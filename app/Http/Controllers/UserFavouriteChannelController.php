<?php

namespace App\Http\Controllers;

use App\Telecasts;
use App\TvChannels;
use App\UserFavouriteChannel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFavouriteChannelController extends Controller
{
    public function myChannelsAction()
    {
        $user_id = Auth::user()->id;

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
            ->join('user_favourite_channel','user_favourite_channel.channel_id','=','tv_channels.id')
            ->whereDay('telecast_show.show_start',$day - 3)
            ->whereMonth('telecast_show.show_start', $month)
            ->where('user_favourite_channel.user_id',$user_id)
            ->orWhere('user_favourite_channel.channel_id','tv_channels.id')
            ->select('tv_channels.id','tv_channels.name as channel','telecasts.name','age_rating.name as age_rating','categories.name as category','telecast_show.show_start','telecast_show.show_end')
            ->get();

        $result = [];

        foreach ($teleprogramms as $teleprogramm) {
            $tmp = Carbon::create($teleprogramm->show_start);
            $teleprogramm->hoursMinutesStart = $tmp->format('H:i');
            $tmp = Carbon::create($teleprogramm->show_end);
            $teleprogramm->hoursMinutesEnd = $tmp->format('H:i');
            if (!key_exists($teleprogramm->channel, $result)) {
                $result[$teleprogramm->channel] = [];
            }
            $result[$teleprogramm->channel][] = $teleprogramm;

        }

        return view('myChannels', compact('date', 'result'));

    }

    public function addChannelAction(Request $request)
    {
        $user_id = Auth::user()->id;
        $channel = $request->get('channel');


        $channel_id = TvChannels::where('tv_channels.name',$channel)
            ->select('tv_channels.id')->first();

        $checkExists = UserFavouriteChannel::where('user_favourite_channel.user_id',$user_id)
            ->where('user_favourite_channel.channel_id',$channel_id->id)
            ->first();

        if($checkExists !=null) {
            return redirect()->back()->with('message', 'Этот канал уже добавлен!');
        }
        else {
            $userFavouriteChannel = new UserFavouriteChannel([
                'user_id' => $user_id,
                'channel_id' => $channel_id->id,
            ]);

            $userFavouriteChannel->save();

            return redirect()->back()->with('message', 'Канал добавлен!');
        }
    }

    public function deleteFavouriteAction(Request $request)
    {

        $user_id = Auth::user()->id;
        $channel = TvChannels::where('name' ,$request->get('channel'))->first();

        $userFavouriteChannel = UserFavouriteChannel::where('user_id', $user_id)
            ->where('channel_id', $channel->id)->first();

        $userFavouriteChannel->delete();

        return redirect()->back()->with('message', 'Канал удален!');
    }
}
