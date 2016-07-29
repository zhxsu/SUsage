<?php 
session_start();
require_once("../functions/to_sql.php");
include("../functions/NightShift.php");
?>

<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>个人中心 / SUsage UCenter</title>
		<link rel="stylesheet" type="text/css" href="../res/css/modules/ex-ucenter.css">
		<link rel="stylesheet" href="../res/css/editor/cropper.min.css">
		<link rel="shortcut icon" href="../res/icons/title/login_128X128.ico"/>
		<link rel="stylesheet" href="../res/css/themes/Sinterface.css" />
		<link rel="stylesheet" href="../res/css/modules/ex-united.css" />
		<script src="../res/js/lrz.all.bundle.js"></script>
		<script src="../res/js/jquery-2.2.1.min.js" type="text/javascript"></script>
		<script src="../res/js/cropper.min.js"></script>
		<script src="../res/js/ucenter.js"></script>
		<script src="../res/js/basic.js"></script>
	</head>
	<body>
	<!--导航栏从此开始 -->
		<div class="ex-navbar-for-Desktop">
			<!--用户标签-->
			<div class="ex-dnavbar-userbox appbox-selected">
				<div class="ex-dnavbar-userbox-avatarfixbox">
					<img src="<?php echo $_SESSION['headimg']; ?>" style="height:54px;width:54px;" />
				</div>
				<div class="ex-dnavbar-userbox-usernamefixbox">
					<p class="ex-dnacvar-userbox-username">
						<?php 
						echo $_SESSION['nickname']." , ";
							if ($h<5) echo '该休息了';
							else if ($h<11) echo '早上好呀';
							else if ($h<13) echo '到中午了';
							else if ($h<18) echo '下午好嘛';
							else if ($h<23) echo '天黑了呢';
							else echo '该休息了';
						?>
					</p>
				</div>
				<div class="ex-dnavbar-userbox-descunderunfixbox">
					<a onclick="backtop(); return false" class="ex-dnavbar-userbox-descunderunfb" href="#">返回顶部 ▲ </a>&#12288;<a onclick="exit(); return false" class="ex-dnavbar-userbox-descunderunfb" title="戳一下就退出哦w">注销 ></a>
				</div>
			</div>
			<div id="appfixbox">
				<a href="index.php">
					<div class="ex-dnavbar-appbox" title="接好任务啊~">
						<img src="../res/icons/bar/ic_task.png"/>
						<div class="ex-dnavbar-appbox-text">主页</div>
					</div>
				</a>
				<a href="bill.php">
					<div class="ex-dnavbar-appbox" title="闷声才能发大财">
					<img src="../res/icons/bar/ic_files.png"/>
						<div class="ex-dnavbar-appbox-text">账务</div>
					</div>
				</a>
			</div>			
		</div>
		<!--导航栏结束 -->
		<!--退出提示-->
		<div class="toast" id="toast-exit" style="position:fixed;width:100%;height:69px;z-index:100;display:none;">
			<label class="toast-label" style="font-family:微软雅黑;color:#ffffff;position:absolute;left:10%;line-height:45px;">你你你你你你你~真的要退出吗w</label>
			<button class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:10%;line-height:55px;font-size:16px;cursor:pointer;" onclick="window.location.href='logout.php'">是的</button>
			<button id="cancelexit" class="btn" style="font-family:微软雅黑;color:#ffffff;position:absolute;right:20%;line-height:55px;font-size:16px;font-weight:bold;cursor:pointer;">不是</button>
		</div>
		<article class="htmleaf-content">
			<div class="subtitle"><h2 style="color:#4fb4f7">个人中心<span style="font-size: 14px"> / UCenter</span></h2></div>
			<!-- fieldsets -->
			<center id="avatarset" class="card">
				<h2 class="fs-title">露个脸呗<span style="font-size: 14px"> / Avatar</span></h2>
				<h3 class="fs-subtitle">上传你的头像<span style="color:red">  建议使用正方形图片</span><br><span style="color:#00c853">墙裂建议在更换图像前确认你“个人信息”模块中填写的数据已提交</span></h3>
					<div id="showResult" style="display: block;">
						<div style="width: 50%;margin: 0 auto;margin-top: 10px;">
							<input id="image" type="file" accept="image/*" capture="camera">
						</div>
						<div id="changeAvatar" style="margin-top: 35px;"><img src="<?php echo $_SESSION['headimg']; ?>" class="avt">
						</div>
					</div>
					<div id="showEdit" style="width: 400px; height: 400px; position: absolute; left: 15%; z-index: 9; display: none;">
						<div style="width:100%;z-index:999999;position: absolute;top:10px;left:0px;border-radius: 4%">
							<button class="avbtn" id="cancleBtn" style="z-index:99999;float:left;margin-left:10px;background-color: #fff;color:#000">取消</button>
							<button class="avbtn" id="confirmBtn" style="z-index:999999;float:right;margin-right: 10px;">确定</button>
						</div>
						<div id="report">
							<img src="" style="margin-left: 0px; margin-top: 0px; transform: none;">
							<span class="cropper-dashed dashed-h cropper-hidden"></span>
							<span class="cropper-dashed dashed-v cropper-hidden"></span>
							<span class="cropper-center"></span>
							<span class="cropper-face cropper-invisible cropper-move"></span>
							<span class="cropper-line line-e cropper-hidden" data-action="e"></span>
							<span class="cropper-line line-n cropper-hidden" data-action="n"></span>
							<span class="cropper-line line-w cropper-hidden" data-action="w"></span>
							<span class="cropper-line line-s cropper-hidden" data-action="s"></span>
							<span class="cropper-point point-e cropper-hidden" data-action="e"></span>
							<span class="cropper-point point-n cropper-hidden" data-action="n"></span>
							<span class="cropper-point point-w cropper-hidden" data-action="w"></span>
							<span class="cropper-point point-s cropper-hidden" data-action="s"></span>
							<span class="cropper-point point-ne cropper-hidden" data-action="ne"></span>
							<span class="cropper-point point-nw cropper-hidden" data-action="nw"></span>
							<span class="cropper-point point-sw cropper-hidden" data-action="sw"></span>
							<span class="cropper-point point-se cropper-hidden" data-action="se"></span>
						</div>
					</div>		
			</center> 
			<!--这个模块需要对新的id验证是否与已有的id重复-->
			<center id="pwset" class="card">
				<h2 class="fs-title">个人信息<span style="font-size: 14px"> / Information</span></h2>
				<h3 class="fs-subtitle">修改你的密码。看准了，别写错</h3>
					<input class="text-input ipt" type="password" name="pass" placeholder="不要告诉别人你的密码" />
					<input class="text-input ipt" type="password" name="cpass" placeholder="请再输一遍密码" />
					<input type="button" name="submit2" class="btn raised green" style="width:60%" value="修改密码" />
				<h3 class="fs-subtitle" style="color: #bdbdbd">—————— or ——————</h3>
				<h3 class="fs-subtitle">修改SUsage ID和昵称，请来这里</h3>
					<input class="text-input ipt" type="text" name="fname" placeholder="新的昵称" />
				<p style="color:#909090;font-size:12px;color:red">请牢记，这也是你的SUsage ID。</p>
				<p style="color:#909090;font-size:12px">嗯，如果你改了大名，或者是部门调动，请联系管理员<span style="color:#4fb4f7">(主席团、电脑部APP组成员)</span>修改。</p>
				<input type="submit" name="submit3" class="btn raised green" style="width:60%" value="确认昵称"/>
			</center>
			<center id="helper" class="card">
				<h2 class="fs-title">反馈与帮助中心<span style="font-size: 14px"> / Feedback</span></h2>
				<h3 class="fs-subtitle">遇到使用中的问题，或者寻求帮助，可以联系我们</h3>
				<h3 class="fs-subtitle" style="color: #bdbdbd">—————— 用户群 ——————</h3>
				<span>企鹅群：<a>XXXXXXXXX</a></span><br><br>
				<span>这里是微信二维码</span><br><br>
				<span>当然，遇到问题，也可以私聊群里的技术负责人员。</span><br><br>
				<h3 class="fs-subtitle" style="color: #bdbdbd">—————— 或者 ——————</h3>
				<input type="submit" name="contact1" class="btn raised green" style="display:inline-block" value="查看Github上的帮助" onclick="window.location.href = 'https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks'" /><br><br>
				<span>建议每位新用户都查看。<br><br>
			</center>
		</article>
		<script src="../res/js/basic.js"></script>
		<script>
		function easteregg(){
			if(event.altKey  &&  event.shiftKey  &&  event.keyCode == 71){
				window.location.href = "about.html";
			}
		}
		document.onkeydown = function(){easteregg();};
		</script>	
	</body>
</html>