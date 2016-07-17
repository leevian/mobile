<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller {


	public function __construct(Request $request)
	{
		$this->request = $request;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($info)
	{
		
		// $info['province']= $info['privilege'][0].','.$info['privilege'][1];
		// unset($info['privilege']);
		// var_dump($info);
		$save['openid']=$info['openid'];
		$save['nickname']=$info['nickname'];
		$save['sex']=$info['sex'];
		$save['language']=$info['language'];
		$save['city']=$info['city'];
		$save['province']=$info['province'];
		$save['country']=$info['country'];
		$save['headimgurl']=$info['headimgurl'];
		$save['onlytwo']=md5(time().rand(0, 1000));
		$id = DB::table('users')->insertGetId($save);
		return $id;
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function exists($openid)
	{
		$results = DB::table('users')->where('openid','=',$openid)->first();
		
		$results = (array)$results;
		
		if($results){
			return $results;
		}else{
			return false;
		}
	}

	public function userInfo($id){
		$results = DB::table('users')->where('id','=',$id)->first();
		
		$results = (array)$results;
		
		if($results){
			return $results;
		}else{
			return false;
		}
	}
	/**
	 * 
	 *
	 * @return Response
	 */
	public function getCp($id,$onlytwo)
	{	
		
		$results = DB::table('relation')->where('onlytwo','=',$onlytwo)->where('u_id','<>',$id)->first();
		
		$results = (array)$results;
		return $results;
		
	}

	
	public function getInfo($u_id){
		if(isset($u_id['cp'])){
			$results = DB::table('info')->where('u_id','=',$u_id['cp'])->orwhere('u_id','=',$u_id['id'])->orderBy('CreateTime', 'desc')->get();

		}else{
			$results = DB::table('info')->where('u_id','=',$u_id['id'])->orderBy('CreateTime', 'desc')->get();

		}
		$results = (array)$results;

		return $results;
	}

	public function getInfoFromDate($u_id,$day,$tomorrow){
	
		if(isset($u_id['cp'])){
			$results = DB::table('info')->where('u_id','=',$u_id['cp'])->orwhere('u_id','=',$u_id['id'])->whereBetween('CreateTime',[$day,$tomorrow])->orderBy('CreateTime', 'desc')->get();

		}else{
			$results = DB::table('info')->where('u_id','=',$u_id['id'])->whereBetween('CreateTime',[$day,$tomorrow])->orderBy('CreateTime', 'desc')->get();

		}
		$results = (array)$results;
		

		return $results;
	}

	public function getInfoDetail($type,$id){
		$table = $type.'_info';
		$results = DB::table($table)->where('id','=',$id)->first();
		return (array)$results;

	}
}
