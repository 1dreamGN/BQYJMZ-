<?php$index = '1';require_once ('common.php');if ($_GET['type'] == "add") {$qq=$_POST['qq'];$name=$_POST['name'];$link=$_POST['link'];$addtime=date('Y-m-d');	if ($db->query("insert into {$prefix}link (qq,name,link,addtime) values ('$qq','$name','$link','$addtime')")) {		exit("<script language='javascript'>alert('友情链接添加成功！');window.location.href='weblink.php';</script>");	} else {		exit("<script language='javascript'>alert('添加友情链接失败');window.location.href='weblink.php';</script>");	}}if ($_GET['type'] == "edits") {$id=$_GET['id'];$link=$_POST['link'];	if ($db->query("update {$prefix}link set link='{$link}' where id='$id'")) {		exit("<script language='javascript'>alert('友情链接编辑成功！');window.location.href='weblink.php';</script>");	} else {		exit("<script language='javascript'>alert('编辑友情链接失败');window.location.href='weblink.php';</script>");	}}if ($_GET['type'] == 'del') {	$id = $_GET['id'];	if (!$db->query("delete from {$prefix}gonggao where id='$id'")) {		exit("<script language='javascript'>alert('删除友情链接成功！');window.location.href='weblink.php';</script>");	}}C('webtitle', '友情链接');C('pageid', 'weblink');include_once 'common.head.php';?>	<div id="content" class="app-content" role="includes">	<div id="Loading" style="display:none">		<div ui-butterbar="" class="butterbar active"><span class="bar"></span></div>	</div><div class="app-content-body">	<section id="container"><div class="bg-light lter b-b wrapper-md hidden-print"><h1 class="m-n font-thin h3">友情链接</h1></div><div class="wrapper-md ng-scope">    <div class="wrapper-md control"><div class="row">			<?php			if($_GET['type']!="edit"){			?>			            <div class="col-sm-12">            <div class="panel panel-default">                <div class="panel-heading">                    基本设置                </div>                <div class="panel-body">                    <form action="?type=add" role="form" method="post">			<input type="hidden" name="do" value="new">                        <div class="list-group-item bb">                            <div class="input-group">                                <div class="input-group-addon">网址人QQ</div>                                <input class="form-control" type="text" name="qq" placeholder="请输入要添加友情链接网站人的QQ">                            </div>                        </div>                        <div class="list-group-item bb">                            <div class="input-group">                                <div class="input-group-addon">网站名称</div>                                <input class="form-control" type="text" name="name" placeholder="请输入要添加的网站名称">                            </div>                        </div>                        <div class="list-group-item bb">                            <div class="input-group">                                <div class="input-group-addon">友情链接</div>                                <input class="form-control" type="text"  name="link" placeholder="（注意：请不要加http://  ）请输入要发布的友情链接地址">                            </div>                        </div>                        <div class="list-group-item">                            <button class="btn btn-primary btn-block" type="submit" name="submit" value="点击发布">保存设置                            </button>                        </div>                    </form>                </div>            </div>        </div>	    <div class="row">        <div class="col-sm-12">            <div class="panel panel-default">                <div class="panel-heading">                    QQ列表                </div>                <div class="panel-body">                    <div class="table-responsive">                        <table class="table table-striped">                            <thead>                            <tr>							 <th>QQ</th>                                <th>发布人昵称</th>                                <th>链接地址</th>                                <th>添加时间</th>                                <th>操作</th>								<th>操作</th>                            </tr>                            </thead>                            <tbody>                            <?php                $rows = $db->query("select * from {$prefix}link where 1=1 order by id desc");                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {                    ?>                                <tr>                            <td><?=$row['qq']?></td>                            <td><?=$row['name']?></td>                            <td><?=$row['link']?></td>                            <td><?=$row['addtime']?></td>                                    <td><a href="?type=del&id=<?=$row['id']?>" class="btn btn-danger"                                           onClick="if(!confirm('确认删除？')){return false;}">删除</a>&nbsp;</td>										    <td><a href="?type=edit&id=<?=$row['id']?>" class="btn btn-danger">编辑</a>&nbsp;</td>                                </tr>                            <?php } ?>                            </tbody>                        </table>                    </div><?php			}else{			$id=$_GET['id'];			$gg=$db->query("select * from {$prefix}link where id='$id' limit 1");			if(!$row=$gg->fetch(PDO::FETCH_ASSOC)){			exit("<script language='javascript'>alert('要编辑的公告不存在！');window.location.href='weblink.php';</script>");			}?><div class="panel panel-default">			<div class="panel-heading">                    公告编辑			</div>			<div class="panel-body">			<div class="list-group">			<form action="?type=edits&id=<?=$id?>" role="form" class="form-horizontal" method="post">			<input type="hidden" name="do" value="new">			<div class="list-group-item">				<div class="input-group">					<div class="input-group-addon">QQ</div>					<input type="text" name="qq" placeholder="<?=$row['qq']?>" value="<?=$row['qq']?>" class="datepicker input-sm form-control" readonly="<?=$row['qq']?>">				</div>			</div><div class="list-group-item">				<div class="input-group">					<div class="input-group-addon">昵称</div>					<input type="text" name="name" placeholder="<?=$row['name']?>" class="input-sm form-control" value="<?=$row['name']?>" readonly="<?=$row['name']?>">				</div>			</div>			<div class="list-group-item">				<div class="input-group">					<div class="input-group-addon">内容</div>					<textarea class="form-control parsley-validated" name="link" rows="6" data-minwords="6" data-required="true" placeholder="请输入要发布的友情链接内容"><?=$row['link']?></textarea>				</div>			</div>			<div class="list-group-item">				<input type="submit" name="submit" value="修改" class="btn btn-primary btn-block">			</div>			</form>		</div></div></div><?php			}?>	  <?phpinclude_once 'common.foot.php';?>