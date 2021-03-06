<?php 
session_start();
require_once("../functions/to_sql.php");
require_once("../functions/CheckLogged.php");
include("../functions/SO_API.php");

$UID=GetSess('userid');
$pubman=GetSess('truename');
$dep=array();
$dep=GetSess('dep');
$sql="SELECT * FROM task_list WHERE pubman='{$pubman}'";
for($i=0;$i<sizeof($dep);$i++){
 $sql.=" OR redep LIKE '%{$dep[$i]}%'";
}
$sql.=" ORDER BY Taskid DESC";
$sql=mysqli_query($conn,$sql);

$all=file_get_contents("../GlobalNotice.json");
$all=json_decode($all);
$Notice=urldecode($all->notice);
$Notice_man=$all->pubman;
$Notice_time=$all->pubtime;

$CSSPath=array("themes","themes","editor","modules","modules");
$CSSName=array("bootstrap","Sinterface","wangEditor","united");

if($_SESSION['SU_M']==1){
	array_push($CSSName,"index-master");
}else{
	array_push($CSSName,"index-normal");
}

include("../functions/NightShift.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>你的任务 / SUsage Tasklist</title>
		<link rel="shortcut icon" href="../res/icons/title/task_128X128.ico"/>
		<?php ShowCSS($CSSPath,$CSSName); ?>	
	</head>
	
	<body style="position:absolute;width:80%;">
	<?php ShowNavbar(); ?>
		<!-- [begin]全局通知 -->
		<div id="globalnote" class="modhide">
			<h3 style="padding-top: 60px">最高指示</h3>
			<p style="height:130px;width:80%;font-size:14px;position:relative;left:10%;overflow-y:auto;word-wrap:break-word;">
			发布人：<?php echo $Notice_man; ?>&#12288;&#12288;
			发布时间：<?php echo $Notice_time; ?><br>
			<span style="font-family: 'microsoft yahei'">公告内容:</span><br>
			<!--内容区域开始-->
			<?php echo $Notice; ?>
			<!--内容区域结束-->
			<br>
			<span style="font-family: 'microsoft yahei'">————————我可是有底线的————————</span>
			</p>
			<center><button class='btn-fff' style="margin:10px 0 20px 0" onclick='closenote(); return false'>知道了</button></center>
		</div>
		<!--[end]全局通知-->

		<div id="panel">
		<!-- 放在顶上的版权声明-->
		<div id="about" class="ex-about" style="position:absolute;top:90px;width:100%;text-align:center;z-index:1;">
			<a href="" onclick="opennote() ;return false" style="background-color:#c90000;color: #fff;padding:1px 5px 1px 5px;border-radius:15px"><span><?php echo $Notice_time; ?></span>最高指示</a>&#12288;
			<a href="https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks" target="_blank" style="color:#00C853">帮助与反馈中心 </a> <a id="ver"></a><span class="tohide"> ©2017 <a href="https://zhxsu.com" target="_blank" style="color:#9e9e9e">执信学生会</a> <a href="https://github.com/zhxsu" target="_blank"  style="color:#9e9e9e">电脑部</a> · In tech we trust </span>
		</div>
		
		<!-- 发布器以及任务界面 -->
		<div id="poster" class="container text-center">
			<div class="row text-center" style="padding: 0px"> 
				<div class="well col-lg-12" style="padding:0;height:465px">
					<div class="col-md-12" style="padding:0">
						<h3 style='font-family:微软雅黑;margin-top:5px;left:0px;font-size:16px;position:relative;margin-left:15px;line-height:20px;color:#bbb'>发布任务( · ω · )<span class="tohide" style="position:relative;color:#FF0000;margin-top:5px;font-family:微软雅黑;font-size:12px;text-align:center">&#12288;我们屏蔽了F5以防止你误刷新页面。</span></h3>
						<div id='edtcontainer'>
							<textarea id='textarea1' style='position:inherit;border-radius:5px;height:350px;width:100%;padding:0px 0px 0px 0px;display:block'></textarea>
						</div>
						<div id='treecontainer' style='display:none'>
							<div style="z-index:999999;margin-top: 5px">
								<center style="font-size: 13px;margin-bottom: 15px">当部门对应的复选框被勾选后，此部门下所有的成员将接收到该任务。</center>
								<div>					
									<div class="checkbox m">
										<input type="checkbox" id="CheckAll" onclick="CheckAll()">
										<label for="CheckAll" style="display:none"></label>
										<span class="lablink">全&#12288;选</span>
									</div>
									<div class="checkbox m">
										<input type="checkbox" id="checkDNB" name="ckdep[]" onclick="CheckClick()" value="电脑部">
										<label for="checkDNB" style="display:none"></label>
										<span class="lablink">电脑部</span>
									</div>
									<div class="checkbox m">
										<input type="checkbox" id="checkDST" name="ckdep[]" onclick="CheckClick()" value="电视台">
										<label for="checkDST" style="display:none"></label>
										<span class="lablink">电视台</span>
									</div>					
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkNWB" name="ckdep[]" onclick="CheckClick()" value="内务部">
									<label for="checkNWB" style="display:none"></label>
									<span class="lablink">内务部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkGGB" name="ckdep[]" onclick="CheckClick()" value="公关部">
									<label for="checkGGB" style="display:none"></label>
									<span class="lablink">公关部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkGBZ" name="ckdep[]" onclick="CheckClick()" value="广播站">
									<label for="checkGBZ" style="display:none"></label>
									<span class="lablink">广播站</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkAU" name="ckdep[]" onclick="CheckClick()" value="社联">
									<label for="checkAU" style="display:none"></label>
									<span class="lablink">社&#12288;联</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkWYB" name="ckdep[]" onclick="CheckClick()" value="文娱部">
									<label for="checkWYB" style="display:none"></label>
									<span class="lablink">文娱部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkXCB" name="ckdep[]" onclick="CheckClick()" value="宣传部">
									<label for="checkXCB" style="display:none"></label>
									<span class="lablink">宣传部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkXSB" name="ckdep[]" onclick="CheckClick()" value="学术部">
									<label for="checkXSB" style="display:none"></label>
									<span class="lablink">学术部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkTYB" name="ckdep[]" onclick="CheckClick()" value="体育部">
									<label for="checkTYB" style="display:none"></label>
									<span class="lablink">体育部</span>
								</div>
								<div class="checkbox m">
									<input type="checkbox" id="checkZXT" name="ckdep[]" onclick="CheckClick()" value="主席团">
									<label for="checkZXT" style="display:none"></label>
									<span class="lablink">主席团</span>
								</div>
							</div>
						</div>
					</div>
					<button class='btn raised green' id='nextstep' onclick='gotoNextStep(); return false'>下一步</button>
					<button class='btn raised green' id='laststep' onclick='gotoLastStep(); return false' style='display:none'>上一步</button>
					<button class='btn raised green' id='submit' style='display:none' onclick='GetTaskInfo();'>发布任务</button>
				</div>
			</div>
		</div>
		<!-- [begin]任务界面 -->
		<div id="listarea">
		<?php 
		while($rs=mysqli_fetch_array($sql)){
			$name=$rs['pubman'];//发布人
			$pubdep=$rs['pubdep'];//发布部门
			$Tid=$rs['Taskid'];
			$head_sql="SELECT headimg FROM sys_user WHERE tname='$name'";
			$veri_sql="SELECT isVerified FROM sys_user WHERE tname='$name'";
			$headquery=mysqli_query($conn,$head_sql);
			$head=mysqli_fetch_array($headquery);
			$veriquery=mysqli_query($conn,$veri_sql);
			$veri=mysqli_fetch_array($veriquery);
			$headimg=$head['headimg'];//发布人头像
			$verified=$veri['isVerified'];//认证标志
		?>
			<div class="container">
			<div class="row" style="padding:0"> 
			<div class="well col-lg-12" style="padding:0">
			<div class="col-md-12" style="padding:0">
				<img class="headimg" src="<?php echo $headimg; ?>">
				<div class="userinfo">
				<span class="name"><?php echo $name; ?></span>
				<?php 
				if($verified=="1"){
				?>
				<span class="verify" title="认证用户">⚡</span>
				<?php 
				}
				?>
				<span class="pubgroup"><?php echo $pubdep; ?></span>
				</div>
				<span class="time">发布于<span><?php echo $rs['pubtime']; ?></span></span>
				<div class="contentarea">
				  <?php echo $rs['ct']; ?>
				</div>
				<div>
				<?php
				if($name==$pubman){//自己发布的任务
					$cpt_sql="SELECT * FROM task_complete WHERE Taskid='$Tid' AND isComplete='1'";
					$cpt_rs=mysqli_query($conn,$cpt_sql);
					$cpt=mysqli_num_rows($cpt_rs);
				?>
				<div style="margin:8px 15px;">
					<div id='click<?php echo $Tid;?>'><a class='btn-danger' onclick='checkDel("<?php echo $Tid; ?>");'>删除任务</a></div>
					<div id='check<?php echo $Tid;?>' style='display:none'><a class='btn-danger' onclick='DeleteTask("<?php echo $Tid; ?>");' title="再点一下">点击确认</a></div>
				</div>
				<a class='finishsum' onclick='opencpt("<?php echo $Tid; ?>");'>已有<span class='sumsty'><?php echo $cpt; ?></span>人完成</a>
				<?php 
				}else{
    $cpt_sql="SELECT * FROM task_complete WHERE Taskid='$Tid' AND Userid='$UID'";
    $cpt_query=mysqli_query($conn,$cpt_sql);
				     $cpt_rs=mysqli_fetch_array($cpt_query);
    if($cpt_rs["isComplete"]=="0"){
				 ?>
				<div style="float: right;margin:15px 10px">
					<div id="cptClick<?php echo $Tid; ?>"><button class='btn' onclick='checkcpt("<?php echo $Tid; ?>");'>完成任务</button></div>
					<div id="cptCheck<?php echo $Tid; ?>" style="display:none;" onclick='CompleteTask("<?php echo $Tid; ?>");'><button class="btn" title="再点一下">点击确认</button></div>
				</div>
        <?php }else{ ?>
    			<div style="color:#00c857;float:right;margin:10px">你已经完成任务</div>
        <?php } } ?>
        </div>
      </div>
      </div>
      </div>
      </div>
      <?php } ?>
      <center class="ex-end" >—————— 我可是有底线的 ——————</center>
      </div>
    </div>
		<!-- [begin]任务完成模块 -->
		<div id="whofinished" class="modhide">
			<h3><div id="PeopleNum"></div></h3>
			<div style="height:230px;width:80%;position:relative;left:10%;overflow-y:auto" id="Showing"></div>
			<center><button class='btn-fff' style="margin:10px 0 20px 0" onclick='closecpt(); return false'>知道了</button></center>
		</div>

<!--脚本引用-->
<?php 
$JSName=array("jquery-2.2.1.min","wangEditor","GetCodeVer");
ShowJS($JSName);
?>
<script src="../functions/Task/TaskAjax.js"></script>

<script type="text/javascript">
var editor = new wangEditor('textarea1');
var submitbtn = document.getElementById('nextstep');
var ckdep = document.getElementsByName("ckdep[]");
var cl = ckdep.length;

//页面自启动:隐藏下一步按钮
window.onload=function(){
	submitbtn.style.display='none';
}

function CheckAll(){
var Checking = document.getElementById("CheckAll");
  if(Checking.checked){
    for(i=0;i<cl;i++){
      ckdep[i].checked = true;
      pstbtn.style.display = 'inline-block';
    }
  }else{
    for(i=0;i<cl;i++){
      ckdep[i].checked = false;
      pstbtn.style.display = 'none';
    }
  }
}

function CheckClick(){
var Checking = document.getElementById("CheckAll");
NotCheck=0;isCheck=0;

for(var k=0;k<cl;k++){
 if(ckdep[k].checked){
   pstbtn.style.display = 'inline-block';
   isCheck++;
 }else if(!ckdep[k].checked){
   NotCheck++;
   Checking.checked=false;
 }
}
if(isCheck==cl){
 Checking.checked=true;
}
if(NotCheck==cl){
  pstbtn.style.display = 'none';
}
}
 
editor.onchange = function(){
	if(this.$txt.html()=="<p><br></p>"){
		submitbtn.style.display = 'none';
	}else{
		submitbtn.style.display = 'inline-block';
	}
};

editor.create();

//确认删除任务，切换按钮
function checkDel(tid){
	document.getElementById('click'+tid).style.display = "none";
	document.getElementById('check'+tid).style.display = "";
}

//确认完成任务，切换按钮
function checkcpt(tid){
	document.getElementById('cptClick'+tid).style.display = "none";
	document.getElementById('cptCheck'+tid).style.display = "";
}

function GetTaskInfo(){
	//获取任务内容
	var html=editor.$txt.html();
	//获取任务发布对象部门
	var dep="";
	for(i=0;i<cl;i++){
	 if(ckdep[i].checked){
		  dep += ckdep[i].value;
		  dep += ",";
	 }
 }
 //去除末尾的逗号
 dep = dep.substr(0,dep.length-1);
 PublishTask(html,dep);
}

function opennote(){	
	$("#globalnote").removeClass("modhide");
	$("#globalnote").addClass("moddisplay");
	$("#globalnote").addClass("animate fadeInDown");
}
//关闭全局通知窗口
function closenote(){
	$("#globalnote").removeClass("fadeInDown");
	$("#globalnote").addClass("animate fadeOutUp");
	$("#globalnote").addClass("modhide");
}

//关闭WFD窗口
function closecpt(){
	$("#whofinished").removeClass("fadeInDown");
	$("#whofinished").addClass("fadeOutUp");
	$("#whofinished").addClass("modhide");
	$("#panel").removeClass("disablemod");
}
//打开WFD窗口
function opencpt(Taskid){
	GetWhoFinished(Taskid);
}

//发布器的切换
var iptbox = document.getElementById('edtcontainer');
var treebox = document.getElementById('treecontainer');
var nextbtn = document.getElementById('nextstep');
var lastbtn = document.getElementById('laststep');
var pstbtn = document.getElementById('submit');
			
function gotoLastStep(){
	treebox.style.display = 'none';
	iptbox.style.display = '';
	lastbtn.style.display = 'none';
	nextbtn.style.display = '';
	pstbtn.style.display = 'none';
}

function gotoNextStep(){
	treebox.style.display = 'inline-block';
	iptbox.style.display = 'none';
	lastbtn.style.display = '';
	nextbtn.style.display = 'none';
	pstbtn.style.display = 'none';
}
</script>

<?php
if($_SESSION['SU_M']==1){
	echo "<script src='../res/js/lockkey.js'></script>";
	echo '<script type="text/javascript">document.onkeydown = function(){lockf5();};</script>';
}
?>
</body>
</html>