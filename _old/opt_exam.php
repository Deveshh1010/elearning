<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AOT Extented - จัดการข้อสอบ</title>
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<script src="plugins/jQuery.min.js" language="javascript"></script>
<?php
require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
$isTime = (time()-3600);

/////////////////////////////////////////////
/////////////////////////////////////////////
$idUser = 23; // Vars User Login ID
/////////////////////////////////////////////
/////////////////////////////////////////////

?>
<script language="javascript">
var monthThai = ['<?php echo _January;?>', '<?php echo _February;?>', '<?php echo _March;?>', '<?php echo _April;?>', '<?php echo _Mays;?>', '<?php echo _June;?>', '<?php echo _July;?>', '<?php echo _August;?>', '<?php echo _September;?>', '<?php echo _October;?>', '<?php echo _November;?>', '<?php echo _December;?>'];
$(document).ready(function(){
	formatTime();
});

function formatTime()
{
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth();
	var day = now.getDate();
	var hour = now.getHours();
	var minute = now.getMinutes();
	var second = now.getSeconds();
		
	$('#time_clock').html('(วันที่ ' + day + ' ' + monthThai[month] + ' ' + (year+543) + ' เวลา ' + hour + ':' + minute + ' น. ' + second + ' วินาที)');
}
setInterval("formatTime()", 100);
</script>
</head>
<body>
<h3>ข้อสอบ <span id="time_clock"></span></h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr style="background-color:#cccccc; font-weight:bold;">
    <td width="340"><span style="margin-left:15px;">หน่วยการเรียนรู้</span></td>
    <td width="110">วันที่สอบ</td>
    <td width="80" align="center">เวลาที่สอบ</td>
  </tr>
  <?php
  foreach($database->Query("SELECT * FROM exam WHERE type='E' AND finish_date>=$isTime;") as $exam):
  $isLesson = $database->Query("SELECT * FROM lesson_unit WHERE unit_id='$exam[unit_id]' LIMIT 1;"); ?>
  <tr height="28">
    <td><strong><span style="margin-left:5px;"><a href="do_exam.php?opt=<?php echo $exam['exam_id']; ?>">หน่วยการเรียนรู้ที่ <?php echo $exam['unit_id'].' '.$isLesson['unit_name']; ?></a></span></strong></td>
    <td><?php echo ThaiDate::Mid($exam['start_date']); ?></td>
    <td align="center">
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
  </tr>
  <?php endforeach; ?>
  <?php if(!$database->Query("SELECT * FROM exam;")): ?>
    <td colspan="3">ไม่มีข้อมูล</td>
  <?php endif; ?>
</table>
<h3>แบบทดสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr style="background-color:#cccccc; font-weight:bold;">
    <td width="50" align="center">ทำข้อสอบ</td>
    <td width="360"><span style="margin-left:15px;">หน่วยการเรียนรู้</span></td>
    <td width="80" align="center">คะแนน</td>
  </tr>
  <?php foreach($database->Query("SELECT * FROM exam WHERE type='T';") as $exam):
  $isLesson = $database->Query("SELECT * FROM lesson_unit WHERE unit_id='$exam[unit_id]' LIMIT 1;");
  $newCount = $database->Query("SELECT COUNT(*) FROM member_answer WHERE member_id=$idUser AND (SELECT answer_id FROM exam_question WHERE question_id=member_answer.question_id AND exam_id=$exam[exam_id])=answer_id;");	
  ?>
  <tr height="28">
    <td align="center"><?php
	if(isset($_SESSION['score_test'][$exam['exam_id']])) $oldCount = $_SESSION['score_test'][$exam['exam_id']];
    if($oldCount<6 && $newCount<6 && !isset($_SESSION['pass'][$exam['exam_id']])) {
		echo '<a href="do_exam.php?test&opt='.$exam['exam_id'].'"><strong>เลือก</strong></a>';
	} elseif(($newCount>5 && $newCount!=10) && !isset($_SESSION['old_ans']) && !isset($_SESSION['pass'][$exam['exam_id']])) {
		$_SESSION['score_test'][$exam['exam_id']] = $newCount;
		echo '<a href="do_exam.php?test&opt='.$exam['exam_id'].'"><strong>ครั้งสุดท้าย</strong></a>';
	} else {
		if($newCount<$oldCount && !isset($_SESSION['pass'][$exam['exam_id']])) {
			foreach($_SESSION['old_ans'] as $qkey=>$akey) {
				$database->Query("DELETE FROM member_answer WHERE member_id=$idUser AND question_id=$qkey;");
				if($akey) $database->Query("INSERT INTO member_answer (member_id, question_id, answer_id) VALUES ($idUser, $qkey, $akey)");
			}
		}
		$_SESSION['pass'][$exam['exam_id']] = 1;
		unset($_SESSION['old_ans'], $_SESSION['score_test']);
		echo '<strong style="color:#090">ผ่านแล้ว</strong>';
	}	
	?></td>
    <td><strong><span style="margin-left:5px;">หน่วยการเรียนรู้ที่ <?php echo $exam['unit_id'].' '.$isLesson['unit_name']; ?></span></strong></td>
    <td align="center"><?php 	
	echo $database->Query("SELECT COUNT(*) FROM member_answer WHERE member_id=$idUser AND (SELECT answer_id FROM exam_question WHERE question_id=member_answer.question_id AND exam_id=$exam[exam_id])=answer_id;");	
	?></td>
  </tr>
  <?php endforeach; ?>
  <?php if(!$database->Query("SELECT * FROM exam;")): ?>
    <td colspan="3">ไม่มีข้อมูล</td>
  <?php endif; ?>
</table>
<?php unset($_SESSION['eid'], $_SESSION['etime']); ?>
</body>
</html>