<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeamDetails;
use App\Models\UserDetails;
use App\Models\CourtDetails;
use App\Models\MatchDetails;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\NotificationDetails;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public static function homePage()
    {
        return view('index');
    }
    public static function squadPage()
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();
        
        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        //check logged in user role
        $userRole = $userDetails->role;
        //use role to determine which column to use to populate squad data
        $getTeamDetailsRow = [];
        $retrievedSquadDetails = [];
        $squadDetailsArr = [];
        $populatedData = [];
        if ($userRole == "manager") {
            $getTeamDetailsRow = TeamDetails::select(
                'id',
                'name',
                'location',
                'squad',
            )->where('owner_id', $user->id)->first()->toArray();
            
            if (count($getTeamDetailsRow)) {
                $squadDetailsArr = json_decode($getTeamDetailsRow['squad'],true);
                if ($squadDetailsArr != null) {
                    foreach ($squadDetailsArr as $key => $value) {
                        $playerDetails = UserDetails::select(
                            'id',
                            'fullname',
                            'dob',
                            'state',
                            'position',
                        )
                        ->where('user_id', $value)->first()->toArray();
                        $retrievedSquadDetails[] = [
                            'player_id' => $playerDetails['id'],
                            'player_fullname' => $playerDetails['fullname'],
                            'player_dob' => $playerDetails['dob'],
                            'player_state' => $playerDetails['state'],
                            'player_position' => $playerDetails['position'],
                        ];
                    }
        
                    // First, sort the array by player_position
                    usort($retrievedSquadDetails, function ($a, $b) {
                        return strcmp($a['player_position'], $b['player_position']);
                    });
        
                    // Next, populate the data based on player_position as the key
                    $populatedData = [];
                    foreach ($retrievedSquadDetails as $player) {
                        $playerPosition = $player['player_position'];
                        if (!isset($populatedData[$playerPosition])) {
                            $populatedData[$playerPosition] = [];
                        }
                        $populatedData[$playerPosition][] = $player;
                    }
                }
            }
        }
        //populate squad data into an nested array to make it easy to use in blade
        return view('squad')
        ->with('userDetails', $userDetails)
        ->with('getTeamDetailsRow', json_decode($getTeamDetailsRow['squad'],true))
        ->with('retrievedSquadDetails', $retrievedSquadDetails)
        ->with('populatedData', $populatedData);
    }
    public static function schedulePage()
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();
        
        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        $userRole = $userDetails->role;
        $matchDetails = [];
        $userTeamID = "";

        if ($userRole == "manager") {
            try {
                $getTeamID = TeamDetails::select(
                    'id',
                )->where(
                    'owner_id', $user->id
                )->first()->toArray();
    
                $userTeamID = $getTeamID['id'];
            } catch (\Throwable $th) {
                return view('profile')->with('userDetails', $userDetails);
            }
        }
        
        if ($userRole == "player") {
            try {
                $getTeamID = TeamDetails::select(
                    'id',
                )->whereRaw(
                    "JSON_CONTAINS(squad, CAST(CONCAT('[\"', ?, '\"]') AS JSON), '$')", [$user->id]
                )->first()->toArray();
    
                $userTeamID = $getTeamID['id'];
            } catch (\Throwable $th) {
                return view('profile')->with('userDetails', $userDetails);
            }
        }

        if ($userTeamID != "") {
            $getMatchDetails = MatchDetails::select(
                'id',
                'type',
                'hometeam',
                'awayteam',
                'homescore',
                'awayscore',
                'homeyellowcard',
                'homeredcard',
                'awayyellowcard',
                'awayredcard',
                'referee',
                'homescorer',
                'awayscorer',
                'datetime',
                'status',
                'location',
            )
            ->where('hometeam', $userTeamID)
            ->orWhere('awayteam', $userTeamID)
            ->orderBy('datetime')
            ->get()->toArray();

            // Loop through each match in the array
            foreach ($getMatchDetails as &$match) {
                if ($match['hometeam'] == $userTeamID) {
                    $match['this_user_belongs_to'] = "hometeam";
                } else {
                    $match['this_user_belongs_to'] = "awayteam";
                }
            }

            foreach ($getMatchDetails as &$match) {
                $getHomeTeamName = TeamDetails::where('id', $match['hometeam'])->pluck('name')->first();
                $match['hometeam'] = $getHomeTeamName;
                $getAwayTeamName = TeamDetails::where('id', $match['awayteam'])->pluck('name')->first();
                $match['awayteam'] = $getAwayTeamName;
                $getRefereeName = UserDetails::where('id', $match['referee'])->pluck('fullname')->first();
                $match['referee'] = $getRefereeName;
                $getCourtName = CourtDetails::where('id', $match['location'])->select('name', 'location', 'type')->first();
                $match['location'] = $getCourtName->name . " - " . $getCourtName->location . " - " . $getCourtName->type;
            }

            // Group the matches by month and year using the 'datetime' column
            $matchesByMonthYear = [];
            foreach ($getMatchDetails as $match2) {
                $datetime = \Carbon\Carbon::parse($match2['datetime']);
                $yearMonth = $datetime->format('F Y');

                // If the group for this year-month doesn't exist, create it
                if (!isset($matchesByMonthYear[$yearMonth])) {
                    $matchesByMonthYear[$yearMonth] = [];
                }

                // Add the match to the corresponding year-month group
                $matchesByMonthYear[$yearMonth][] = $match2;
            }
            
        } else {
            return view('profile')->with('userDetails', $userDetails);
        }

        // return view('schedule')->with('userDetails', $userDetails)->with('matchesByMonth', $matchesByMonth)->with('getMatchDetails', $getMatchDetails);
        return view('schedule')->with('userDetails', $userDetails)->with('matchesByMonthYear', $matchesByMonthYear)->with('getMatchDetails', $getMatchDetails);
        // return view('schedule')->with('userDetails', $userDetails)->with('getMatchDetails', $getMatchDetails);
    }

    public static function add_new_eventPage()
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();
        
        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        $getReferees = UserDetails::select(
            'id',
            'fullname',
            'role',
            'user_id',
        )
        ->where('role', "referee")->get()->toArray();

        $opponentTeam = TeamDetails::select(
            'id',
            'name',
            'status',
        )->where('owner_id', '!=', $user->id)->get()->toArray();

        $courtList = CourtDetails::select(
            'id',
            'name',
            'location',
            'status',
            'type',
            'contact',
        )->where(
            'status', "available"
        )->get()->toArray();

        return view('addnewevent')
        ->with('userDetails', $userDetails)
        ->with('getReferees', $getReferees)
        ->with('courtList', $courtList)
        ->with('opponentTeam', $opponentTeam);
    }

    public static function create_teamPage()
    {
        return view('createteam');
    }

    public static function resultsPage()
    {
        return view('results');
    }
    public static function statsPage()
    {
        return view('stats');
    }
    public static function loginPage()
    {
        return view('login');
    }
    public static function registerPage()
    {
        return view('register');
    }
    public static function forgot_passwordPage()
    {
        return view('forgot_password');
    }
    public static function request_joinPage()
    {
        $teamDetails = TeamDetails::select(
            'id',
            'name',
            'location'
        )
        ->get()->toArray();
        return view('requestjoin')->with('teamDetails', $teamDetails);
    }
    public static function approvePage()
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();
        
        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();
        $userRole = $userDetails->role;

        $notiDetails = NotificationDetails::select(
            'id',
            'type',
            'details'
        )
        ->where('type', $userRole.":".$user->id)
        ->get()->toArray();

        $notiDetailsDecode = [];
        $userNotiDetails = [];
        $notiDetailsUserDetails = [];

        if (count($notiDetails) > 0) {
            foreach ($notiDetails as $key => $value) {
                if ($value['details'] != "") {
                    $notiDetailsDecode[] = json_decode($value['details'], true);
                    // Add the 'id' field to the last element of $notiDetailsDecode
                    $notiDetailsDecode[count($notiDetailsDecode) - 1]['notification_row_id'] = $value['id'];
                }
            }
        }

        if (count($notiDetailsDecode) > 0) {
            foreach ($notiDetailsDecode as $key => $value) {
                if ($value['notification_type'] == "join_team_request") {
                    $userNotiDetails = UserDetails::where('user_id', $value['player_id'])->first()->toArray();
                    $notiDetailsUserDetails[][$value['notification_type']] = $userNotiDetails;
                }
                if ($value['notification_type'] == "match_proposal") {
                    $userNotiDetails = TeamDetails::where('id', $value['request_team'])->first()->toArray();
                    $courtName = CourtDetails::select(
                        'id',
                        'name',
                        'location',
                        'type',
                    )->where(
                        'id', $value['court']
                    )->first()->toArray();
                    $notiDetailsUserDetails[][$value['notification_type']] = $userNotiDetails;
                    $notiDetailsUserDetails[$key][$value['notification_type']]['notification_details'] = $notiDetailsDecode;
                    $notiDetailsUserDetails[$key][$value['notification_type']]['court_name'] = $courtName['name'] . " - " . $courtName['location'] . " - " . $courtName['type'];
                }
            }
        }
        // $userNotiDetails = UserDetails::where()->first();
        return view('approve')
        ->with('notiDetailsUserDetails', $notiDetailsUserDetails)
        ->with('userDetails', $userDetails);
    }
    public static function matchPage()
    {
        return view('match');
    }

    public static function profilePage()
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();

        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();
        // Log::info(['userDetails' => $userDetails]);
        return view('profile')->with('userDetails', $userDetails);
    }
   
    public static function edit_profilePage()
    {
        return view('editprofile');
    }
    
    // ==================================
    // API
    // ==================================
    public static function register(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|unique:users',
            'uname' => 'required|string',
            'psw' => 'required|min:6|confirmed',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }


        $email = $request->email;
        $uname = $request->uname;
        $psw = $request->psw;

        try {
            $userTableInsert = User::create([
                'email' => $email,
                'name' => $uname,
                'password' => bcrypt($psw),
            ]);

            return response()->json([
                'success' => true,
                'data' => $userTableInsert,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public static function forgotPassword (Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'psw' => 'required|min:6|confirmed',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $email = $request->email;
        $psw = $request->psw;


        try {

            $user = User::where('email', $email)->first();

            if ($user) {
                $user->update([
                    'password' => bcrypt($psw)
                ]);

                // Password updated successfully
                return response()->json(['success' => true, 'message' => 'Password updated']);
            } else {
                // User not found
                return response()->json(['success' => false, 'message' => 'User not found']);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }

        
    }


    public static function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication successful
            // return Redirect::route('home');
            return response()->json([
                'success' => true,
                'message' => 'login success',
            ], 200);
        } else {
            // Authentication failed
            // return Redirect::route('login')->with('error', 'Invalid login credentials');
            return response()->json([
                'success' => false,
                'error' => 'Invalid login credentials',
            ], 400);
        }
    }

    public static function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Logout success',
        ], 200);
    }

    public static function editProfile (Request $request)
    {

        $user = Auth::user(); // Get the currently authenticated user
        // return response()->json(['success' => true, 'users' => $user]);

        $validatedData = Validator::make($request->all(), [
            'fullname' => 'required',
            'dob' => 'required',
            'role' => 'required',
            'state' => 'required',
            'position' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $fullname = $request->fullname;
        $dob = $request->dob;
        $role = $request->role;
        $state = $request->state;
        $position = $request->position;


        try {

            $userDetailsInsertOrUpdate = UserDetails::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'fullname' => $fullname,
                    'dob' => $dob,
                    'role' => $role,
                    'state' => $state,
                    'position' => $position,
                ]
            );

            return response()->json(['success' => true, 'db_update' => $userDetailsInsertOrUpdate]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public static function createteam(Request $request)
    {

        $user = Auth::user(); // Get the currently authenticated user
        // return response()->json(['success' => true, 'users' => $user]);

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }


        $name = $request->name;
        $location = $request->location;

        try {
            $userTableInsert = TeamDetails::create([
                'name' => $name,
                'location' => $location,
                'owner_id' => $user->id,
                'squad' => " ",
                'win' => 0,
                'draw' => 0,
                'lose' => 0,
                'goalfor' => 0,
                'goalagainst' => 0,
                'status' => "active",
            ]);

            return response()->json([
                'success' => true,
                'data' => $userTableInsert,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public static function requesttojointeamapi(Request $request) 
    {
        $user = Auth::user(); // Get the currently authenticated user
        // return response()->json(['success' => true, 'users' => $user]);

        $validatedData = Validator::make($request->all(), [
            'teamid' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $teamid = $request->teamid;

        $notificationDetails = [
            'notification_type' => "join_team_request",
            'player_id' => $user->id
        ];

        $teamOwnerId = TeamDetails::select(
            'owner_id'
        )
        ->where('id', $teamid)
        ->first();
        // notificationDetails = {'player_id':1}
        // use $teamid to get the team owner_id and the team details
        // notification type = manager:20

        try {
            $notiTableInsert = NotificationDetails::create([
                'type' => 'manager:'.$teamOwnerId->owner_id,
                'details' => json_encode($notificationDetails),
            ]);
            return response()->json([
                'success' => true,
                'data' => $notiTableInsert,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public static function applicationApprovalApi(Request $request)
    {
        // return response()->json([
        //     'success' => true,
        //     'data' => $request->all(),
        // ], 200);

        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();

        // Fetch the user details from the database based on the user_id.
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        $playerId = $request->playerId;
        $btnClickType = $request->btnClickType;
        $notiType = $request->notiType;

        if ($notiType == "join_team_request") {
            $selectNotiRow = NotificationDetails::select(
                'id'
            )->where(
                'type', $userDetails->role.":".$user->id
            )->where(
                'details->player_id', $playerId
            )->first()->toArray();
    
            $findNoti = NotificationDetails::find($selectNotiRow['id']);
            if ($btnClickType == "reject") {
    
                $findNoti->delete();
    
                return response()->json([
                    'success' => true,
                    'data' => "notification deleted",
                ], 200);
            } else {
    
                $getTeamDetailsSquad = TeamDetails::select(
                    'id',
                    'owner_id',
                    'squad',
                    'name',
                    'location'
                )->where(
                    'owner_id', $user->id
                )->where(
                    'status', 'active'
                )->first()->toArray();
    
                try {
                    if ($getTeamDetailsSquad['squad'] == null) {
                        $isiThis = [$playerId];
                        $updateSquad = TeamDetails::where(
                            'owner_id', $user->id
                        )->where(
                            'status', 'active'
                        )->first();
                        $setToSquad = $updateSquad->update([
                            'squad' => json_encode($isiThis)
                        ]);
                    } else {
                        $squadListStr = $getTeamDetailsSquad['squad'];
                        $squadListArray = json_decode($squadListStr,true);
                        $squadListArray[] = $playerId;
                        $updateSquad = TeamDetails::where(
                            'owner_id', $user->id
                        )->where(
                            'status', 'active'
                        )->first();
                        $setToSquad = $updateSquad->update([
                            'squad' => json_encode($squadListArray)
                        ]);
                    }
                    
                    
                    $findNoti->delete();
                    return response()->json([
                        'success' => true,
                        'data' => $updateSquad,
                        'message' => "database updated successfully",
                    ], 200);
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'error' => $e->getMessage(),
                    ], 400);
                }
            }
        } elseif ($notiType == "match_proposal") {
            $notificationId = $playerId;
            $findNoti = NotificationDetails::find($notificationId);
            if ($btnClickType == "reject") {
    
                $findNoti->delete();
    
                return response()->json([
                    'success' => true,
                    'data' => "notification deleted",
                ], 200);
            } else {
                $notiDetails = NotificationDetails::select(
                    'id',
                    'type',
                    'details'
                )
                ->where('id', $notificationId)
                ->first()->toArray();

                //home team id from request_team
                $notiDetailsDecode = json_decode($notiDetails['details'], true);

                // take id of the away team
                $away_team = TeamDetails::select(
                    'id',
                    'owner_id'
                )->where(
                    'owner_id', $user->id
                )->first()->toArray();

                try {
                    $insertMatchDetails = MatchDetails::create([
                        'type' => $notiDetailsDecode['match_type'],
                        'hometeam' => $notiDetailsDecode['request_team'],
                        'awayteam' => $away_team['id'],
                        'homescore' => 0,
                        'awayscore' => 0,
                        'homeyellowcard' => 0,
                        'homeredcard' => 0,
                        'awayyellowcard' => 0,
                        'awayredcard' => 0,
                        'referee' => $notiDetailsDecode['referee'],
                        'homescorer' => "",
                        'awayscorer' => "",
                        'datetime' => $notiDetailsDecode['date'] . " " . $notiDetailsDecode['time'],
                        'status' => "match_scheduled",
                        'location' => $notiDetailsDecode['court'],
                    ]);

                    $findNoti->delete();
                    return response()->json([
                        'success' => true,
                        'data' => "match confirmed",
                    ], 200);
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'error' => $e->getMessage(),
                    ], 400);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'error' => $request->all(),
                'message' => "only join team request and match proposal request will be handle for now"
            ], 400);
        }
    }

    public static function addNewEventApi(Request $request)
    {
        // Assuming you have the authenticated user's ID available.
        $user = Auth::user();

        $validatedData = Validator::make($request->all(), [
            'opponent_team' => 'required',
            'match_type' => 'required',
            'date' => 'required',
            'time' => 'required',
            'referee' => 'required',
            'court' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }


        $opponent_team = $request->opponent_team;
        $match_type = $request->match_type;
        $date = $request->date;
        $time = $request->time;
        $referee = $request->referee;
        $court = $request->court;

        $request_team = TeamDetails::select(
            'id',
            'owner_id'
        )->where(
            'owner_id', $user->id
        )->first()->toArray();

        $opponent_team_owner_id = TeamDetails::select(
            'owner_id'
        )
        ->where('id', $opponent_team)
        ->first();

        // notify opponent for match acceptance

        $notificationDetails = [
            'notification_type' => "match_proposal",
            'match_type' => $match_type,
            'date' => $date,
            'time' => $time,
            'referee' => $referee,
            'court' => $court,
            'request_team' => $request_team['id'],
        ];

        try {
            $notiTableInsert = NotificationDetails::create([
                'type' => 'manager:'.$opponent_team_owner_id->owner_id,
                'details' => json_encode($notificationDetails),
            ]);
            return response()->json([
                'success' => true,
                'data' => $notiTableInsert,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }

    }
}
