<?php

namespace App\Http\Controllers;

use App\Categories;
use App\TvChannels;
use App\UserFavouriteChannel;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function indexAction()
    {
        $channels = TvChannels::all();
        $categories = Categories::where('is_channel_type',1)->get();
        $text = '';
        $counts = '';
        foreach ($categories as $category){
            $text .= '"'.$category->name .'",';

            $value = UserFavouriteChannel::join('tv_channels','tv_channels.id','user_favourite_channel.channel_id')
                ->where('tv_channels.category_id',$category->id)->count('user_favourite_channel.channel_id');

            $counts .= $value .',';
        }
        $headerText = "Типы каналов, добавленные в избранное";

        return view('statistic',compact('text','counts','channels'));;
    }

    public function chosenChannelStatisticAction(Request $request)
    {
        $channels = TvChannels::all();

        $channel = TvChannels::where('tv_channels.id',$request->get('channel'))->first();
        $text = '';
        $counts = '';

            $text .= '"'.$channel->name .'",';

            $value = UserFavouriteChannel::join('tv_channels','tv_channels.id','user_favourite_channel.channel_id')
                ->where('user_favourite_channel.channel_id',$channel->id)->count('user_favourite_channel.channel_id');

            $counts .= $value .',';

        return view('statistic',compact('text','counts','channels'));;
    }
}
