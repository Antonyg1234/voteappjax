<?php

namespace App\Http\Controllers\Frontend;

use App\Model\EventMaster;
use App\Model\EventParticipant;
use App\Model\EventParticipantsMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('frontend.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        foreach($request->names as $key => $mobile){
//            echo $mobile;echo '<br>';
//            echo $request->mobiles[$key];echo '<br>';
//            echo $request->emails[$key];echo '<br>';
//        }
//        die('');
       // dd(Input::all());
        $this->validate($request,[
            'team_name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10|numeric',
            'mobiles.*' => 'required|digits:10|numeric',
        ]);

        $event = new EventParticipant();
        $event->event_id = $request->event_id;
        $event->team_name = $request->team_name;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->contact_person = $request->contact_person;
        $event->email = $request->email;
        $event->mobile = $request->mobile;
        $event->save();

        $event_p_id = $event->id;

        foreach($request->names as $key => $name){
            $event_members = new EventParticipantsMember();
            $event_members->event_p_id = $event_p_id;
            $event_members->event_id = $request->event_id;
            $event_members->name = $name;
            $event_members->email = $request->emails[$key];
            $event_members->mobile = $request->mobiles[$key];
            $event_members->save();
        }

        return redirect('/')->with('success', ['You have been registered successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = EventMaster::where('id','=',$id)->first();

        //dd($event->toArray());
        return view('frontend.registration',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
