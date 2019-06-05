<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AOT Extented - จัดการข้อสอบ</title>
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<script src="plugins/jQuery.min.js" language="javascript"></script>
<script language="javascript">

function changeShowAnswer(object, examid, status)
{
	var isShowAns = 0;
	if(status==0) { isShowAns = 1; }
	$.ajax({ url: 'ajax_exam.php?ans_show=change',
		data: ({ id : examid, show : isShowAns }),
		error: function() {
			alert('Error: answer=change');
		},
		success: function() {
			if(isShowAns==0) {
				$(object).removeAttr('checked', 'checked');
			} else {
				$(object).attr('checked', 'checked');
			}
			$(object).attr('alt',isShowAns);
		},
	});
}

function examDel(id)
{
	var answer = confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")
	if(answer) {
		$.ajax({ url: 'ajax_exam.php?del=exam',
			data: ({ id: id }),
			dataType: "json",
			type: "POST",
			error: function() {
				alert('Error: DELETE=examDel');
			},
			success: function(data) {
				window.location.reload();
			},
		});
	}
}

</script>
</head>
<?php
require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
?>
<body>
<h3>จัดการข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="chk_exam.php">ตรวจข้อสอบ</a> | <a href="ad_add_exam.php">เพิ่มข้อสอบใหม่</a> | <a href="index.php">กลับไปหน้าแรก</a></td>
  </tr>
</table>
<h3>ข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr style="background-color:#cccccc; font-weight:bold;">
    <td>หน่วยการเรียนรู้</td>
    <td>วันที่สอบ</td>
    <td align="center">เวลาที่สอบ</td>
    <td align="center">เฉลยข้อสอบ</td>
  </tr>
  <?php foreach($database->Query("SELECT * FROM exam;") as $exam): list($isLesson) = $database->Query("SELECT * FROM lesson_unit WHERE unit_id=$exam[unit_id];"); ?>
  <tr height="30">
    <td width="360"><strong><span style="margin-left:5px;"><span title="ลบข้อมูล" class="del_quest" id="<?php echo $exam['exam_id']; ?>" onclick="examDel($(this).attr('id'))">X</span>&nbsp;
    <a href="ad_edit_exam.php?id=<?php echo $exam['exam_id']; ?>">หน่วยการเรียนรู้ที่ <?php echo $exam['unit_id'].' '.$isLesson['unit_name']; ?></a></span></strong></td>
    <?php if($exam['type']=='E'): ?>
    <td width="150"><?php echo ThaiDate::Mid($exam['start_date']); ?></td>
    <td width="110" align="center">
	<?php
	$isStartTime = getdate($exam['start_date']);
	$isFinsihTime = getdate($exam['finish_date']);
	if(strlen($isStartTime['hours'])==1) { echo '0'; }
    echo $isStartTime['hours'].'.';
	if(strlen($isStartTime['minutes'])==1) { echo '0'; }
	echo $isStartTime['minutes'].' - ';
	if(strlen($isFinsihTime['hours'])==1) { echo '0'; }
	echo $isFinsihTime['hours'].'.';
	if(strlen($isFinsihTime['minutes'])==1) { echo '0'; }
	echo $isFinsihTime['minutes'].' น.'; 
	?></td>
    <td width="80" align="center">
      <input type="checkbox" id="show_ans" <?php if($exam['show_ans']!=0) echo 'checked="checked"'; ?>
       alt="<?php echo $exam['show_ans']; ?>" onclick="changeShowAnswer(this, <?php echo $exam['exam_id']; ?>, $(this).attr('alt'))" />
    </td>
    <?php else: ?>
     <td colspan="3" align="center"><strong>แบบทดสอบไม่มีระยะเวลากำหนด</strong></td>
    <?php endif; ?>
  </tr>
  <?php endforeach; ?>
  <?php if(!$database->Query("SELECT * FROM exam;")): ?>
    <td colspan="4">ไม่มีข้อมูล</td>
  <?php endif; ?>
</table>
</body>
</html>