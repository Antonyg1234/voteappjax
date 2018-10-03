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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if ($request->ajax()) {

//            print_r($request->allmembers);die();

            if ($this->validate($request, [
                'team_name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'contact_person' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|digits:10|numeric',
            ])) {

                $email_availablity_as_member = EventParticipantsMember::where('email', $request->email)
                    ->where('event_id', $request->event_id)
                    ->get()
                    ->count();

                if ($email_availablity_as_member == 0) {

                    $event_participant = new EventParticipant();
                    $event_participant->event_id = $request->event_id;
                    $event_participant->team_name = $request->team_name;
                    $event_participant->title = $request->title;
                    $event_participant->description = $request->description;
                    $event_participant->contact_person = $request->contact_person;
                    $event_participant->email = $request->email;
                    $event_participant->mobile = $request->mobile;
                    $event_participant->save();

                    $event_p_id = $event_participant->id;

                    $members_registerd = EventParticipantsMember::select('email')->where('event_id',$request->event_id)->get()->toArray();

                    if ($request->allmembers) {
                        $members = json_decode($request['allmembers'], true);
                        foreach ($members as $member) {
                            if (in_array($member['member_email'], $members_registerd)) {
                                return response()->json(array(
                                    'success' => false,
                                    'message' => $member['member_email'].' already register for this event.'

                                ));
                            } else {
                                $event_members = new EventParticipantsMember();
                                $event_members->event_p_id = $event_p_id;
                                $event_members->event_id = $request->event_id;
                                $event_members->name = $member['member_name'];
                                $event_members->email = $member['member_email'];
                                $event_members->mobile = $member['member_mobile'];
                                $event_members->save();
                            }
                        }
                        $request->session()->flash('success', 'You have been registered successfully for this event.');
                        $request->session()->flash('message-type', 'success');
                        return response()->json(array(
                            'success' => true,
                            'message' => 'You have been registered successfully for this event.'
                        ));
                    }
                }
                else {
                    return response()->json(array(
                        'success' => false,
                        'message' => 'Sorry, '.$request->email.' already have been registered'
                    ));
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = EventMaster::where('id', '=', $id)->first();

        //dd($event->toArray());
        return view('frontend.registration', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkEmailExistence(Request $request)
    {
//        $email_availablity_as_contact_person = EventParticipant::where('email',$request->memberEmail)
//            ->where('event_id',$request->eventId)
//            ->get()
//            ->count();
//        echo $request->memberEmail;die();

        $email_availablity_as_member = EventParticipantsMember::where('email', $request->memberEmail)
            ->where('event_id', $request->eventId)
            ->get()
            ->count();

        if (/*$email_availablity_as_contact_person == 0 &&*/
            $email_availablity_as_member == 0) {

            return response()->json(array(
                'success' => true,
                'message' => 'Member Added Successfully.'

            ));
        } else {
            return response()->json(array(
                'success' => false,
                'message' => 'Member Email already register for this event.'

            ));
        }
    }
}