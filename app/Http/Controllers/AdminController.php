<?php

namespace App\Http\Controllers;

use App\AgeRating;
use App\Categories;
use App\Countries;
use App\Positions;
use App\Staff;
use App\Telecasts;
use App\TelecastShow;
use App\TelecastStaff;
use App\TvChannels;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAction()
    {
        $channels = TvChannels::all();
        return view('admin.index', compact('channels'));
    }
    public function channelsAction()
    {
        $categories = Categories::where('is_channel_type', 1)->get();
        $countries = Countries::all();
        return view('admin.addChannel', compact('categories', 'countries'));
    }
    public function addChannelAction(Request $request)
    {
        $checkExists = TvChannels::where('id',$request->get('id'))->first();
        if($request->get('category') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали категорию!');
        }
        if($request->get('country') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали страну!');
        }
        if($checkExists != null) {
            return redirect()->back()->with('message', 'Канал с таким названием уже существует!');
        }
        else {
            $channel = new TvChannels([
                'country_id' => $request->get('country'),
                'name' => $request->get('name'),
                'category_id' => $request->get('category'),
                'photo_link' => $request->get('photo_link'),
                'description' => $request->get('description'),
            ]);

            $channel->save();

            return redirect()->back()->with('message', 'Канал добавлен!');
        }

    }

    public function telecastsAction()
    {
        $categories = Categories::where('is_channel_type', 0)->get();
        $age_ratings = AgeRating::all();
        $channels = TvChannels::all();
        return view('admin.addTelecast', compact('categories', 'age_ratings', 'channels'));

    }

    public function addTelecastAction(Request $request)
    {
        $checkExists = Telecasts::where('channel_id',$request->get('channel'))
            ->where('name', $request->get('name'))->first();
        if($request->get('category') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали категорию!');
        }
        if($request->get('age_rating') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали возрастной рейтинг!');
        }
        if($request->get('channel') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали телеканал!');
        }
        if($checkExists != null) {
            return redirect()->back()->with('message', 'Телепередача с таким названием уже существует!');
        }
        else {
            $telecast = new Telecasts([
                'name' => $request->get('name'),
                'category_id' => $request->get('category'),
                'age_rating_id' => $request->get('age_rating'),
                'channel_id' => $request->get('channel'),
            ]);
            $telecast->save();

            return back()->with('message', 'Телепередача добавлена!');
        }
    }

    public function telecastStaffAction(Request $request)
    {
        $channel = $request->get('channel');
        $telecasts = Telecasts::where('channel_id', $channel)->get();
        $staff = Staff::join('positions','positions.id','staff.position_id')
            ->where('channel_id', $request->get('channel'))
            ->select('positions.name as position', 'staff.id','staff.FIO')->get();

        return view('admin.addTelecastStaff', compact('telecasts', 'staff'));
    }
    public function addTelecastStaffAction(Request $request)
    {
        $telecastShow = new TelecastStaff([
            'telecast_id' => $request->get('telecast'),
            'staff_id' => $request->get('staff'),
        ]);

        $telecastShow->save();

        return redirect()->back()->with('message', 'Сотрудник добавлен!');

    }
    public function telecastShowAction(Request $request)
    {
        if($request->get('channel') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали телеканал!');
        }

        $telecasts = Telecasts::where('channel_id',$request->get('channel'))->get();

        return view('admin.addTelecastShow', compact('telecasts'));
    }

    public function addTelecastShowAction(Request $request)
    {
        $curMonth = Carbon::now()->month;
        $curDay = Carbon::now()->day;

        $chosenDate = Carbon::create($request->get('show_start'));

       if($curDay > $chosenDate->day && $curMonth == $chosenDate->month ) {
            return redirect()->back()->with('message', 'Нельзя добавить показ на прощедшую дату!');
       }

        if($request->get('telecast') < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали телепередачу!');
        }
        else {
            $telecastShow = new TelecastShow([
                'telecast_id' => $request->get('telecast'),
                'show_start' => $request->get('show_start'),
                'show_end' => $request->get('show_end'),
            ]);

            $telecastShow->save();

            return redirect()->back()->with('message', 'Показ телепередачи добавлен!');
        }
    }
    public function staffAction(Request $request)
    {
        $channel = $request->get('channel');
        if($channel < 1) {
            return redirect()->back()->with('message', 'Вы не выбрали телеканал!');
        }

        $positions = Positions::all();

        return view('admin.addStaff', compact('positions', 'channel'));
    }

    public function addStaffAction(Request $request)
    {
        $staff = new Staff([
            'channel_id' => $request->get('channel'),
            'FIO' => $request->get('FIO'),
            'position_id' => $request->get('position'),
        ]);

        $staff->save();

        return redirect()->back()->with('message', 'Сотрудник добавлен!');
    }
}
