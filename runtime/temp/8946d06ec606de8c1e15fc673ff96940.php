<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:42:"./application/admin/view/order/export.html";i:1586928879;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>导出</title>
    <style type="text/css">
        table tr td{
            width: 120px;
            height: 25px;
            text-align: center;
        }
    </style>
</head>

<body>

<?php
        if(!empty($intime)){
        $name = $intime.$shop_name;
        }else{
        $name = date("Y-m-d",time()).$shop_name;
        }
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=".$name.".xls");
    /*header("Content-Disposition:attachment;filename=店铺订单汇总导出".$name.".xls");*/
?>

<table border="1">
    <tr>
        <!--<td style="font-weight:bold;">编码</td>         -->
        <!--<td style="font-weight:bold;">上架时间</td>-->
        <td style="font-weight:bold;">完成时间</td>
        <td style="font-weight:bold;">店铺</td>
        <td style="font-weight:bold;">旺旺号</td>
        <!--<td style="font-weight:bold;">关键词</td>-->
        <!--<td style="font-weight:bold;">单价</td>-->
        <td style="font-weight:bold;">实际下单价</td>
        <td style="font-weight:bold;">备注</td>
        <td style="font-weight:bold;"></td>
        <!--<td style="font-weight:bold;">礼品</td>-->
        <!--<td style="font-weight:bold;">手机号</td>-->

        <!--<td style="font-weight:bold;">类型</td>-->
        <!--<td style="font-weight:bold;">订单状态</td>-->
        <!--<td style="font-weight:bold;">异常信息</td>-->
    </tr>
    <?php
    use app\common\model\ShopModel;
    use app\common\model\TaskModel;
    use app\common\model\TaskdetailModel;
    use app\common\model\OrderModel;
    foreach($lists as $v){
    $find_task = TaskModel::find("and id=".$v['task_id']);
    $find_taskdetail = TaskdetailModel::find("and id=".$v['taskdetail_id']);
    $find_shop = ShopModel::find("and id=".$v['shop_id']);
    $type_name = OrderModel::enum_type_text($v['type']);
    $task_status_name = TaskModel::enum_status_text($find_task['status']);
    $status_name = '';
    if($v['type']==1){
        $status_name = OrderModel::enum_status1_text($v['status1']);
    }
    if($v['type']==2){
        $status_name = OrderModel::enum_status2_text($v['status2']);
    }
    if($v['type']==3){
        $status_name = OrderModel::enum_status3_text($v['status3']);
    }
    ?>
    <tr>
        <!--<td style="text-align:left;"><?php echo $v['verifycode']; ?></td>-->
        <!--<td style="text-align:left;"><?php echo date('Y-m-d H:i:s',$v['intime']);?></td>-->
        <td style="text-align:center;"><?php if($v['finishtime']){ echo date('Y-m-d',$v['finishtime']);}?></td>
        <td style="text-align:center;"><?php echo $v['shop_name']; ?></td>
        <td style="text-align:center;"><?php echo $v['wangwang']; ?></td>
        <!--<td style="text-align:left;"><?php echo $find_taskdetail['searchkeywords']; ?></td>-->
        <!--<td style="text-align:left;"><?php echo $v['price']; ?></td>-->
        <td style="text-align:center;"><?php echo $v['payprice']; ?></td>
        
        <td style="text-align:center;"><?php echo $v['remark']; ?></td>
        <td style="text-align:center;"></td>
        <!--<td style="text-align:left;"><?php echo $find_task['present']; ?></td>-->
        <!--<td style="text-align:left;"><?php echo $v['mobile']; ?></td>-->
        <!--<td style="text-align:left;"><?php echo $type_name; ?></td>-->
        <!--<td style="text-align:left;"><?php echo $task_status_name; ?>-<?php echo $status_name; ?></td>-->
        <!--<td style="text-align:left;"><?php echo $v['exceptioninfo']; ?></td>-->
    </tr>
    <?php } ?>
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>
    <tr>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
        <td style="text-align:center;"></td>
    </tr>

</table>
</body>
</html>

    
