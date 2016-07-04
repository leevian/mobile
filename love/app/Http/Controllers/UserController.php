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
		
		$info['province']= $info['privilege'][0].','.$info['privilege'][1];
		unset($info['privilege']);
		$info['onlytwo']=md5(time().rand(0, 1000));
		$id = DB::table('users')->insert($info);
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
	/**
	 * 
	 *
	 * @return Response
	 */
	public function getCp($id,$onlytwo)
	{	
		
		$results = DB::table('relation')->where('onlytwo','=',$onlytwo)->where('u_id','<>',$id)->first();
		
		$results = (array)$results;
		return (array)$results;
		
	}

	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
