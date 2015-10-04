<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<link rel="stylesheet" type="text/css" href="calendar/calendar_css.css"/>
<script src="plugins/jQuery.min.js" language="javascript"></script>
<script src="plugins/jquery.fn.js" language="javascript"></script>
<script src="plugins/jquery.popup.js" language="javascript"></script>
<title>AOT Extented - โกงข้อสอบ</title>
</head>
<?php
require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
if(!isset($_REQUEST['id'])):
?>

<body>
<h3>จัดการข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="ad_exam.php">กลับไปหน้าจัดการข้อสอบ</a></td>
  </tr>
</table>
<h3>ตรวจข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr style="background-color:#cccccc; font-weight:bold;">
    <td>หน่วยการเรียนรู้</td>
    <td align="center">ประเภทการสอบ</td>
  </tr>
  <?php foreach($database->Query("SELECT * FROM exam;") as $exam): $isLesson = $database->Query("SELECT * FROM lesson_unit WHERE unit_id='$exam[unit_id]' LIMIT 1;"); ?>
  <tr height="28">
    <td width="360"><strong><span style="margin-left:15px;"><a href="chk_exam.php?id=<?php echo $exam['exam_id']; ?>">หน่วยการเรียนรู้ที่ <?php echo $exam['unit_id'].' '.$isLesson['unit_name']; ?></a></span></strong></td>
    <td width="50" align="center"><strong><?php if($exam['type']=='E') { echo 'ข้อสอบ'; } else { echo 'แบบทดสอบ'; } ?></strong></td>
  </tr>
  <?php endforeach; ?>
  <?php if(!$database->Query("SELECT * FROM exam;")): ?>
    <td colspan="4">ไม่มีข้อมูล</td>
  <?php endif; ?>
</table>
</body>
</html>
<?php else: 
$isExam = $database->Query("SELECT * FROM exam WHERE exam_id=$_REQUEST[id] LIMIT 1;");
$isLesson = $database->Query("SELECT * FROM lesson_unit WHERE unit_id='$isExam[unit_id]' LIMIT 1;");
$popupWidth = 650;
$popupHeight = 700;
?>
<body>
<h3>จัดการข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="chk_exam.php">กลับไปหน้าตรวจข้อสอบ</a></td>
  </tr>
</table>
<h3>รายชื่อสมาชิก (แบบทดสอบที่ <?php echo $isExam['unit_id'].' '.$isLesson['unit_name']; ?>)</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr style="background-color:#cccccc; font-weight:bold;">
    <td width="60" align="center">ตรวจคำตอบ</td>
    <td width="360" style="padding-left:30px;">ชื่อ-สกุล</td>
    <td width="80" align="center">คะแนน</td>
  </tr>
  <?php
  $answerCount = 0;
  foreach($database->Query("SELECT * FROM member WHERE m_status=1;") as $student): 
  $ansCount = $database->Query("SELECT COUNT(*) FROM exam_question WHERE exam_id=$_REQUEST[id] AND (SELECT COUNT(*) FROM member_answer WHERE member_id=$student[member_id] AND question_id=exam_question.question_id)>0;");
  $answerCount += $ansCount;
  if($ansCount):
  $score = $database->Query("SELECT COUNT(*) FROM member_answer WHERE member_id=$student[member_id] AND 
  							(SELECT answer_id FROM exam_question WHERE question_id=member_answer.question_id AND exam_id=$isExam[exam_id])=answer_id;");
  ?>
  <tr height="25">
    <td align="center"><strong style="cursor:pointer" id="chk_<?php echo $student['member_id']; ?>"><a>ตรวจ</a></strong>
	<script>
    $(document).ready(function(){
      $('#chk_<?php echo $student['member_id']; ?>').popupWindow({
		  windowURL:'chk_answer.php?examid=<?php echo $_REQUEST['id']; ?>&userid=<?php echo $student['member_id']; ?>&title=แบบทดสอบที่ <?php echo $isExam['unit_id'].' '.$isLesson['unit_name']; ?>', centerBrowser:1, width:<?php echo $popupWidth; ?>, height:<?php echo $popupHeight; ?> });
    });
    </script>          
    </td>
    <td><span style="margin-left:15px;"><?php if($student['sex']=='F') { echo 'นางสาว'; } else { echo 'นาย'; } echo $student['firstname'].' '.$student['lastname']; ?></span></td>
    <td align="center"><?php echo $score.'/10'; ?></td>
  </tr>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php if(!$answerCount): ?>
  <tr height="25">
    <td colspan="3" align="center"><strong>ไม่มีข้อมูล</strong></td>
  </tr>
  <?php endif; ?>
</table>

</body>
</html>

<?php endif; ?>
