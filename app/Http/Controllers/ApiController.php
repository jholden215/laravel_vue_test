<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use Validator;
class ApiController extends Controller
{
    public function addTeam(Request $request)
    {
    	$validator = Validator::make($request->all(),['name'=>'required']);
    	if($validator->passes()) {
    		$team = new Team();
    		$team->name = $request->name;
    		$resp = $team->save();
    		if($resp) {
    			$arr=array('status'=>'true','message'=>'Team Successfully Added','data'=>array());
    		} else {
    			$arr=array('status'=>'false','message'=>'Team Not Added','data'=>array());
    		}
    	}
    	else {
    		$arr=array('status'=>'false','message'=>$validator->errors()->all(),'data'=>array());
    	}
    	echo json_encode($arr);
    }
    public function getTeam()
    {
    	$team = Team::orderBy('id','desc')->get()->toArray();
    	if($team){
    		$arr=array('status'=>'true','message'=>'Success','data'=>$team);
    	} else {
    		$arr=array('status'=>'false','message'=>'Team Not Found','data'=>array());
    	}
    	echo json_encode($arr);
    }
    public function addPlayer(Request $request)
    {
    	$validator = Validator::make($request->all(),['team'=>'required','first_name'=>'required','last_name'=>'required']);
    	if($validator->passes()) {
    		$player = new Player();
    		$player->teams_id = $request->team;
    		$player->first_name = $request->first_name;
    		$player->last_name = $request->last_name;
    		$resp = $player->save();
    		if($resp) {
    			$arr=array('status'=>'true','message'=>'Player Successfully Added','data'=>array());
    		} else {
    			$arr=array('status'=>'false','message'=>'Player Not Added','data'=>array());
    		}
    	} else {
    		$arr=array('status'=>'false','message'=>$validator->errors()->all(),'data'=>array());
    	}
    	echo json_encode($arr);
    }
    public function getPlayer($id='')
    {
    	if($id) {
    		$team = Player::select(['players.*','players.teams_id as team','teams.name as team_name'])->where('teams_id',$id)->join('teams','players.teams_id','=','teams.id')->orderBy('id','desc')->get()->toArray();
    	}
    	else 
    	{
    		$team = Player::select(['players.*','players.teams_id as team','teams.name as team_name'])->join('teams','players.teams_id','=','teams.id')->orderBy('id','desc')->get()->toArray();	
    	}
    	if($team){
    		$arr=array('status'=>'true','message'=>'Success','data'=>$team);
    	} else {
    		$arr=array('status'=>'false','message'=>'Player Not Found','data'=>array());
    	}
    	echo json_encode($arr);
    }
    public function editPlayer(Request $request)
    {
    	$validator = Validator::make($request->all(),['team'=>'required','first_name'=>'required','last_name'=>'required']);
    	if($validator->passes()) {
    		$player = Player::where('id',$request->id)->first();
    		$player->teams_id = $request->team;
    		$player->first_name = $request->first_name;
    		$player->last_name = $request->last_name;
    		$resp = $player->update();
    		if($resp) {
    			$arr=array('status'=>'true','message'=>'Player Successfully Updated','data'=>array());
    		} else {
    			$arr=array('status'=>'false','message'=>'Player Not Updated','data'=>array());
    		}
    	} else {
    		$arr=array('status'=>'false','message'=>$validator->errors()->all(),'data'=>array());
    	}
    	echo json_encode($arr);
    }
}
