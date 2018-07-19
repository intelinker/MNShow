<?php

namespace App\Http\Controllers;

use App\Channel;
use App\product;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channel.index', ['channels' => Channel::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channel1 = $this->getChannel1();
        $channel2 = $this->getChannel2();
        $channel3 = $this->getChannel3();
//        dd($channel2);
        return view('channel.create', ['level1'=>$channel1, 'level2'=>$channel2, 'level3'=>$channel3]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allRequest = $request->all();
//                dd($allRequest);
        if ($allRequest['level'] == null) {
            Channel::create(array_merge($allRequest, ['level'=>0]));
        } else {
            Channel::create($allRequest);
        }
//        $allChannels = Channel::all();
//        $channels = array();
//        for ($i=0; $i< count($allChannels); $i++) {
//            $channel = $allChannels[$i];
//
//        }
        return view('channel.index', ['channels' => Channel::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
//        dd($channel);
        echo $channel->id."/";
        $allChannels = Channel::all();
        if ($channel->level != 2) {
            for ($i=0; $i< count($allChannels); $i++) {
                $getChannel = $allChannels[$i];
                if ($getChannel->level1_id == $channel->id || $getChannel->level2_id == $channel->id) {
//                    dd('branch exist');
                    \Session::flash('branch_exist_error', "请先删除渠道'".$channel->name."'的子渠道'".$getChannel->name."''");
                    return redirect('channels');
                }
            }
        }
        $channel->delete();
        return view('channel.index', ['channels' => $allChannels]);
    }

    public function channelCreate0() {
        return view('channel.channelcreate', ['level' => 0, 'channel1' => null, 'channel2' => null]);
    }

    public function channelCreate1($channel1) {
        return view('channel.channelcreate', ['level' => 1, 'channel1' => Channel::findorFail($channel1),  'channel2' => null]);
    }

    public function channelCreate($level, $channel1, $channel2) {
        return view('channel.channelcreate', ['level' => $level, 'channel1' => Channel::findorFail($channel1),
            'channel2' => Channel::findorFail($channel2)]);
    }

    private function getChannel1() {
        $channels = Channel::where('level', 0)->get();
        $level = array();
        for ($i=0; $i< count($channels); $i++) {
            $channel = $channels[$i];
            array_push($level, $channel);
        }
        return $level;
    }

    private function getChannel2() {
        $channel1s = Channel::where('level', 0)->get();
        $channel2s = Channel::where('level', 1)->get();
//        dd($channel2s);
        $levels = array();
        for ($i=0; $i< count($channel1s); $i++) {
            $channel1 = $channel1s[$i];
            $subLevels = array();
            for ($j=0; $j<count($channel2s); $j++) {
                $channel2 = $channel2s[$j];
                if ($channel1->level == $channel2->level1_id) {
                    array_push($subLevels, $channel2);
                }
            }
            array_push($levels, $subLevels);
        }
        return $levels;
    }

    private function getChannel3() {
        $channel1s = Channel::where('level', 0)->get();
        $channel2s = Channel::where('level', 1)->get();
        $channel3s = Channel::where('level', 2)->get();

        $levels = array();
        for ($k=0; $k< count($channel3s); $k++) {
            $channel3 = $channel3s[$k];
            $subChannel3s = array();
            for ($i=0; $i< count($channel2s); $i++) {
                $channel2 = $channel2s[$i];
                $subChannel2s = array();
                for ($j=0; $j<count($channel1s); $j++) {
                    $channel1 = $channel1s[$j];
                    if ($channel1->level == $channel2->level1_id) {
                        array_push($subLevels, $channel1);
                    }
                }
                array_push($subChannel3s, $subChannel2s);
            }
            array_push($levels, $subChannel3s);
        }

        return $levels;
    }

    public function loadChannels() {
        return ['success' => true, 'channels' => Channel::all(), 'products'=>product::all()];
    }
}
