<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;

class WeixinController extends Controller {


	 public function __construct(Request $request)
    {
		$this->request = $request;

        // $this->beforeFilter('weixin', array('on' => 'get|post'));
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		
	}
	public function valid()
    {
		

    	
        if(isset($_GET['echostr'])){
        	$echoStr = $_GET["echostr"];
        	if($this->checkSignature()){
        	
				echo $echoStr;
	        	exit;
	        	
        
        	}
        }else{
        	$this->responseMsg();
        }
        
        
        
    }

	public function responseMsg()
    {
//get post data, May be due to the different environments
    	if(isset($GLOBALS["HTTP_RAW_POST_DATA"])){
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	      	//extract post data
			if (!empty($postStr)){
	                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
	                   the best way is to check the validity of xml by yourself */
	                libxml_disable_entity_loader(true);
	              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	                $fromUsername = $postObj->FromUserName;
	                $toUsername = $postObj->ToUserName;
	                $MsgType = $postObj->MsgType;
	                $keyword = trim($postObj->Content);
	                $time = time();
	                $array = json_decode(json_encode($postObj),TRUE);
	                
	                
	                $result = $this->saveInfoDetail($array);
	              
					
					if($result){
						$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				
              		$msgType = "text";
                	$contentStr = "收到您的消息啦!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
              

			        }else {
			        	echo "";
			        	exit;
			        }
    			}
    		}
	}
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	private function saveInfo($info){
	
		$saveInfo['u_id']=$info['u_id'];
	
		$saveInfo['CreateTime']=$info['CreateTime'];
		$saveInfo['MsgType']=$info['MsgType'];
		$saveInfo['MsgId']=$info['id'];
		if($id = DB::table('info')->insertGetId($saveInfo)){
			return true;
		}else{
			return false;
		}
		
	}



	private function saveInfoDetail($info){
		$openId = $info['FromUserName'];
		unset($info['FromUserName']);
		unset($info['ToUserName']);
		$info_or = $info;
		unset($info['MsgType']);
		$user = DB::table('users')->where('openid', $openId)->first();
		$user = (array)$user;
		if($user){
	    	$info_or['u_id']=$user['id'];
	    	$saveInfo['userName']=$user['id'];
			
	    }else{
	    	$save['openid']=$openId;
			$save['onlytwo']=md5(time().rand(0, 1000));
			$id = DB::table('users')->insertGetId($save);
	    	$saveInfo['userName']=$id;
	    	$info_or['u_id']=$saveInfo['userName'];

	    }

		$data=$info;
		$data['userName']=$info_or['u_id'];
		$tableName = $info_or['MsgType'].'_info';
		$id = DB::table($tableName)->insertGetId($data);
		$info_or['id']=$id;
		if($this->saveInfo($info_or)){
			return true;
		}else{
			return false;
		}

	}

	public function dateInfo(){
		$user = new UserController($this->request);

		$userinfo = $this->request->session()->get('userinfo');
	
		$cpinfo = $user->getCp($userinfo['id'],$userinfo['onlytwo']);
		if(isset($cpinfo['id'])){
			$cpId = $cpinfo['u_id'];
			$cpinfoDetail = $user->userInfo($cpId);
			$data['cpinfo']=$cpinfoDetail;
			$u_ids['cp']=$cpinfo['u_id'];
		}
		
		$u_ids['id']=$userinfo['id'];
		//检测是否发过消息 同时过cpinfo来决定是否要查两个人
		$infoResult = $user->getInfo($u_ids);
	
		$arrayinfo = array();
		foreach ($infoResult as $key => $value) {
			$msgtype = $value->MsgType;
			
			$info = $user->getInfoDetail($msgtype,$value->MsgId);
			
			// echo $info['CreateTime'];
			$info['month']=date('n',$info['CreateTime']);
			$info['day']=date('j',$info['CreateTime']);
			$info['year']=date('Y',$info['CreateTime']);
			
			$arrayinfo['events'][]=$info;
			// array_push($array,$arrayinfo);
		}
		$data['detialinfo']=$arrayinfo;
		echo json_encode($arrayinfo);
	}

}
