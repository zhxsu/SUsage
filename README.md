<b>Zhixin StudentUnion OA System #Codename"SUsage" </b>

<b>执信中学学生会信息化在线办公系统 开源项目 #代号"SUsage" </b>

<b>目前总体开发进度：约66%，前端系统基本完成，后端系统开发约60%。当前build:1E79 (0579)</b>

<b>项目总阶段：0.6-milestone8 #Project SUsage pre-α（开发代号Young）</b>

<p>TaskSYS V1.0 alpha A2</p>
<p>UCenter V1.5-pre alpha A1</p>
<p>AdminSYS V1.2-alpha2</p>
<p>FileTour V0.4-milestone6 【未来project】</p>
<p>Bill V0.2-milestone2</p>
<p><b>Latest update：2016.7.29 16:48</b></p>
<b>©2016 执信学生会 电脑部</b>
<br>
<b>Created By @yyl99311 | @df7c5117 | @GhostShadowTan | @橡胶人AS | @ZhxsuWebGroup</b>
<br>
<b>特别鸣谢：@SmallOyster</b>
<br>
<b>Everyone can modified it except for the already existing codes </b>
<br>
<br>
<h4>本Repo迁移自原zhxsuwebgroup/SUsage<br>在登陆后界面按某个组合键有彩蛋哦~<s>才不会告诉你是alt+shift+g呢</s></h4>
<br>
<h3>这是个啥w</h3>
  <p>嗯，执信学生会的网上办公平台。</p>
  <p>一个神秘的系统，完全由37th SUPC自主研制开发。</p><a href="https://github.com/zhxsu/SUsage/wiki/Susage-%7C-%E6%A6%82%E8%BF%B0" target="_blank">详情请戳这里</a>
  
<a href="http://zhxsu.github.io/SUsage/" target="_blank">美美哒介绍页面</a>

<h3>为啥叫这个名字w</h3>
  <p>StudentUnion简写“SU”和Message的组合自造词。<s>让人酥酥的公告系统</s></p>
  <p><s>雅号香肠</s></p>
<h3>好处都有啥w</h3>
  <s>有了SUsage，不流失不蒸发</s>
  <p>可以发布公告、下载文件、布置任务，省时又省力！</p>
  <p>界面美观又漂亮,【咦有语病</p>
<h3>配置</h3>
  <h4><p>本地可以使用<b>XAMPP1.8.2+</b>调试，服务器端建议最低配置PHP5+, Apache 2.4.17+, phpMyAdmin 4.5.1+</p></h4>
  <p>You can use <b>XAMPP1.8.2+</b> for local debugging.The recommend requirement for Server-side is PHP5+, Apache 2.4.17+, phpMyAdmin 4.5.1+</p>
  <h4><p>请将此文件包<b>放在SUsage文件夹内</b>，然后<b>将SUsage文件夹放在网站根目录</b></p></h4>
  <p>Please put this package into the <b>SUsage</b> directory，then put the <b>SUsage</b> into root directory of your website.</b>
  <h4><p>环境配置完成后，请在PhpMyAdmin中新建susage数据库后导入susage.sql文件。</p></h4>
  <p>After runtime configuration completed,please set a new database which called <b>susage</b> and import <b>susage.sql</b> into this database.</p>
  <h4><p>并在<b>functions/to_sql.php、Admin/Includes/to_pdo.php</b>中按照提示填写您的数据库登录账户和密码</p></h4>
  <p>Then follow the prompts to enter your database login account and password in <b>functions/to_sql.php </b>and <b> Admin/Includes/to_pdo.php</b>
  <h4><p>测试账户1：Enatsu 密码：123456（角色：管理员+组长）</p></h4>
  <p>Test Account 1：Enatsu PW：123456（role：Admin+Group Master）</p>
  <h4><p>测试账户2：Super 密码：supersu（角色：超级管理员）</p></h4>
  <p>Test Account 2：Super PW：supersu（role：SuperUser）</p>
  <h4><p><b>若忘记密码可打开/SUsage/md5.php按照提示输入密码</b></p></h4>
  <p>If you forget your test password, you can open <b>/SUsage/md5.php</b> and follow the prompts to enter your password</p>
  <h4><p><b>点击确认后将Salt和inDB复制，粘帖进数据库中“salt”和“pw”即可。</b></p></h4>
  <p>Copy the Salt and inDB into <b>salt</b> and <b>pw</b> of database after click permit</p>
<h3>近期的事情</h3>
<p><b>----2016.7.27----</b></p>
  <p>使用TXT代替数据库来储存全局通知</p>
  <p>各种CSS优化</p>
<p><b>----2016.7.25----</b></p>
  <p>完成“发布任务”功能</p>
  <p>新增“完成任务”功能（未建设完毕）</p>
  <p>登录时使用cookie记住用户名</p>
  <p>大改数据库结构</p>
  <p>全局公告开始部署</p>
<p><b>----2016.7.18----</b></p>
  <p>bug修复</p>
  <p>使用JS获取系统代码版本</p>
<p><b>----2016.7.13----</b></p>
  <p>移除VegeChat</p>
  <p>bug修复以及各种CSS优化</p>
<p><b>----2016.7.8----</b></p>
  <p>全新界面定名为S interface</p>
  <p>新增实验性版块：SUsage FileTour</p>
  <s>bug一个都没补</s>
<p><b>----2016.7.1----</b></p>
  <p>界面改版，全新视觉体验</p>
  <p>新增实验性功能：Auto NightShift</p>
  <p>UCenter功能升级</p>
  <p>数十项bug解决<s>及新bug产生</s></p>

<h3>亟待修复</h3>
  <p>前台的个人中心（重置密码之类的……）</p>
<h3>注意事项</h3>
  <p>按照<s>基本法</s>wiki里的提示写就好啦</p>
  <a href="https://github.com/zhxsu/susage/wiki" target="_blank">修改时，欢迎参看我们的wiki</a>
<hr></hr>
<h3>开源声明及感谢</h3>
  <p>本项目目前基于以下几个开源项目开发：</p>
* <a href="https://jquery.org/" target="_blank">John Resig</a>的`jQuery`，遵循`MIT`协议
* <a href="https://github.com/nt1m/material-framework/" target="_blank">nt1m</a>的`material-framework`，遵循`Apache`协议版本`2.0`
* <a href="http://wangeditor.github.io/">wangfupeng1988</a>的`WangEditor`，遵循`MIT`协议，新版本采用了SU精简化版本，体积更小，效率更高
* <a href="https://github.com/fengyuanchen/cropper">fengyuanchen</a>的`cropper.js`，遵循`MIT`协议
* Github提供的免费代码仓库


**`GNU General Public Licence `版本`3.0`**
