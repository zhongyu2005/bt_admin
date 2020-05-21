<?php
  $title="web 后台管理";
?>
<?php include(CONST_VIEW.'common/header_admin.php'); ?>
<style type="text/css">
.pre-scrollable{
  min-height: 500px;
}
</style>
<ol class="breadcrumb">
  <li><a href="javascript:;">系统后台</a></li>
  <li><a href="javascript:;">simpleSql</a></li>
  <li class="active">简单工具</li>
</ol>
<form class="form-horizontal" id="formSubmit">
  <div class="form-group">
    <label for="tab_name" class="col-sm-2 control-label">时间戳转日期</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="t_time" name="t_time" value="<?=$_GET['t_time']??''?>" placeholder="请输入时间戳">
    </div>
  </div>
<div class="form-group">
    <label for="tab_name" class="col-sm-2 control-label">日期转时间戳</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="t_date" name="t_date" value="<?=$_GET['t_date']??''?>" placeholder="请输入日期">
    </div>
  </div>	
<div class="form-group">
    <label for="tab_name" class="col-sm-2 control-label">日期转当月最后一天</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="t_date_last" name="t_date_last" value="<?=$_GET['t_date_last']??''?>" placeholder="请输入日期">
    </div>
  </div>

<div class="form-group">
    <label for="tab_name" class="col-sm-2 control-label">日期相差天数</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="t_sdate" name="t_sdate" value="<?=$_GET['t_sdate']??''?>" placeholder="请输入开始日期">
    </div>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="t_edate" name="t_edate" value="<?=$_GET['t_edate']??''?>" placeholder="请输入结束日期">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-1">
      <button type="button" id="btnSubmit" class="btn btn-default">提 交</button>
    </div>
  </div>
  <input type="hidden" name="a" value="<?php echo CONST_ACTION ?>" />
  <input type="hidden" name="m" value="<?php echo CONST_METHOD ?>" />
</form>
    <pre class="pre-scrollable" id="sql-pre">
	<?php if(!empty($_GET['t_time'])){
		echo date("Y-m-d H:i:s",$_GET['t_time']),PHP_EOL;
	} ?>
	<?php if(!empty($_GET['t_date'])){
                echo strtotime($_GET['t_date']),PHP_EOL;
        } ?>
	<?php if(!empty($_GET['t_date_last'])){
		$time=strtotime($_GET['t_date_last']);
                echo date("Y-m-t",$time),PHP_EOL;
        } ?>
	<?php if(!empty($_GET['t_sdate']) && !empty($_GET['t_edate']) ){
                $stime=new \DateTime($_GET['t_sdate'],new \DateTimeZone('PRC'));
                $etime=new \DateTime($_GET['t_edate'],new \DateTimeZone('PRC'));
		$diff=$stime->diff($etime);
		$days=$diff->format('%R%a days ');//天数
                echo $days,PHP_EOL;
        } ?>
    </pre>
<script type="text/javascript">
  function html_load () {
    $("#formSubmit").on("keydown",function(e){
      var key=e.which;
      if(key==13){
        $("#btnSubmit").trigger("click");
      }
    })
    $("#btnSubmit").on("click",function(){
        form_submit();
    })
    $("#sql-pre1,#sql-pre2,#sql-pre3,#sql-pre4,#sql-pre5").on("click",function(){
        /*
        $(this).zclip({
            path: "public/js/ZeroClipboard.swf",
            copy: function(){
              return $(this).html();
            },afterCopy:function(){}
        });
        */
    });
  }

  function form_submit(){
      $("#formSubmit").submit();
  }
</script>

<?php if(isset($showType) && $showType=='tpl' ):?>
  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#action" aria-controls="action" role="tab" data-toggle="tab">Action-tpl</a></li>
    <li role="presentation"><a href="#add" aria-controls="add" role="tab" data-toggle="tab">add-tpl</a></li>
    <li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">edit-tpl</a></li>
    <li role="presentation"><a href="#list" aria-controls="list" role="tab" data-toggle="tab">list-tpl</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <pre class="pre-scrollable" id="sql-pre1"><?php echo htmlspecialchars($table_ddl);?>
        </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="action">
        <pre class="pre-scrollable" id="sql-pre2"><?php echo htmlspecialchars($action_tpl);?>
        </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="add">
        <pre class="pre-scrollable" id="sql-pre3"><?php echo htmlspecialchars($add_tpl);?>
        </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="edit">
        <pre class="pre-scrollable" id="sql-pre4"><?php echo htmlspecialchars($edit_tpl);?>
        </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="list">
        <pre class="pre-scrollable" id="sql-pre5"><?php echo htmlspecialchars($list_tpl);?>
        </pre>
    </div>
  </div>
</div>
<?php endif;?>

<?php include(CONST_VIEW.'common/footer_admin.php'); ?>
