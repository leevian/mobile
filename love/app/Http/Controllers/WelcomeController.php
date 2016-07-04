<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		//用户点击链接
		//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect
		//跳转到本方法
		//如果用户同意授权 获得code

		$userinfo = $this->request->session()->get('userinfo');
		//判断session中是否有用户信息数据 无则需要授权
		$user = new UserController($this->request);

		if(!$userinfo){
			$code = $this->request->has('code');
			//使用guzzle获取微信接口
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSERCET."&code=".$code."&grant_type=authorization_code";
			
			$client = new \GuzzleHttp\Client();
			$res = $client->get($url);
			$res_info = $res->getBody();
			
			$res_info = '{"access_token":"ACCESS_TOKEN","expires_in":7200,"refresh_token":"REFRESH_TOKEN","openid":"OPENID","scope":"SCOPE"}'; 
			$info = json_decode($res_info,true);
			$this->request->session()->put('access_token',$info['access_token']);

			// var_dump($info);
			if(array_key_exists('errcode',$info)){
				//显示错误画面
			}
			//判断用户是否存在
			
			if($userinfo = $user->exists($info['openid'])){
				//如果存在 调用信息数据
				//存session 显示相应数据

				$this->request->session()->put('userinfo',$userinfo);
			
			}else{
				//不存在生成一个user插入表
				$url_user = "https://api.weixin.qq.com/sns/userinfo?access_token=".$info['access_token']."&openid=".$info['openid']."&lang=zh_CN";
				$res_user = $client->get($url_user);
				$res_user_info = $res_user->getBody();
				$res_user_info = '{"openid":"OPENID","nickname":"NICKNAME","sex":"1","province":"PROVINCE","city":"CITY","country":"COUNTRY","headimgurl":    "http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46", "privilege":["PRIVILEGE1","PRIVILEGE2"],"unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"}';
				$userinfo= json_decode($res_user_info,true);
				// if(array_key_exists('errcode',$info_user)){
				// 	//显示错误画面
				// }

				if($id = $user->create($userinfo)){
					//存session 显示相应数据
					$userinfo = $user->exists($userinfo['openid']);
					$this->request->session()->put('userinfo',$userinfo);

				}
			}

		}
		

		//到这里都有用户信息了
		$data['userinfo']=$userinfo;
		// var_dump($userinfo);
		//检查是否邀请过ta
		$cpinfo = $user->getCp($userinfo['id'],$userinfo['onlytwo']);

		
		

		return view('welcome/index',$data);
		
		
	}

	public function invite(){
		$data = array();
		$userinfo = $this->request->session()->get('userinfo');
		
		if($userinfo){
			
			$data['id']=$userinfo['id'];
			$data['onlytwo']=$userinfo['onlytwo'];

			$access_token = $this->request->session()->get('access_token');
			
			//使用guzzle获取微信接口
			$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN";
			// echo $url;
			$client = new \GuzzleHttp\Client();
			$json = array();
			$json[0] = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
			
			$res = $client->post($url,$json);
			$res_info = $res->getBody();
			$res_info_qcode = json_decode($res_info,true);
			var_dump($res_info_qcode);
			return view('welcome/invite',$data);
		}
		

	}

}
