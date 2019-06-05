<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AOT Extented - จัดการข้อสอบ</title>
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<script src="plugins/jQuery.min.js" language="javascript"></script>
<?php

/////////////////////////////////////////////
/////////////////////////////////////////////
$idUser = 23; // Vars User Login ID
/////////////////////////////////////////////
/////////////////////////////////////////////

require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
$choiceAnswer = array('ก','ข','ค','ง');
$isExam = $database->Query("SELECT * FROM exam WHERE exam_id=$_REQUEST[opt] LIMIT 1;");

if($isExam['type']=='E') {
	$isTime = $isExam['finish_date'] - (time());
	$isUse = $isExam['finish_date'] - $isExam['start_date'];
} elseif($isExam['type']=='T') {
	if(!isset($_SESSION['eid'])) {
		$_SESSION['eid'] = $_REQUEST['opt'];
		$_SESSION['etime'] = (time()-3600)+(15*60);
		foreach($database->Query("SELECT * FROM exam_question WHERE exam_id=$_REQUEST[opt];") as $quest) {
			$ansMember = $database->Query("SELECT * FROM member_answer WHERE question_id=$quest[question_id] LIMIT 1;");
			if($_SESSION['score_test'][$_REQUEST['opt']]>5) {
				$_SESSION['old_ans'][$quest['question_id']] = $ansMember['answer_id'];
			}
			$database->Query("DELETE FROM member_answer WHERE member_id=$idUser AND question_id=$quest[question_id];");
		}
	}
	$isTime = $_SESSION['etime'] - (time()-3600);
	$isUse = 15*60;
}

?>
<script language="javascript">
var isRun = 0;
var isTime = <?php echo $isTime; ?>;
var isUse = <?php echo $isUse; ?>;
var isSecond = 0;
var isFinishTime = <?php echo $isTime; ?>;

$(document).ready(function(){
	$('#exam_tensec').fadeOut(0);
	$('#exam_ready').fadeOut(0);
	$('#exam_do').fadeOut(0);
	formatTime();
	
	$('#exam_save').click(function() {
		window.location = "opt_exam.php";
	});
});

function formatTime()
{
	var now = new Date();
	var nowSecond = now.getSeconds();
	if(nowSecond!=isRun) { isRun = nowSecond; isSecond++; isTime = parseInt(isFinishTime - isSecond); }
	if((isTime-isUse)>10) {	
		$('#exam_tensec').fadeIn(0);
		$('#time-wait').html('ยังไม่ถึงเวลาสอบ กรุณารออีก ' + Math.floor((isTime-isUse)/60/60) + ' ชั่วโมง ' +  Math.floor((isTime-isUse)/60)%60 + ' นาที ' + ((isTime-isUse)%60) + ' วินาที');
	} else if((isTime-isUse)>0) {
		$('#exam_tensec').fadeOut(0);
		$('#exam_ready').fadeIn(0);	
		$('#time-wait').html('เตรียมตัวสอบในอีก');
		$('#exam_ready').html(isTime-isUse);	
	} else if((isTime-isUse)==0) {
		$('#time-wait').html('ขอให้โชคดี');
		$('#exam_ready').html('เริ่มทำข้อสอบได้');
	} else if(isTime>0) {
		$('#exam_wait').fadeOut(0);
		$('#exam_do').fadeIn(0);	
	} else if(isTime<0) {
		$('#exam_do').fadeOut(0);
		$('#exam_wait').fadeIn(0);
		$('#exam_ready').fadeIn(0);
		$('#time-wait').html('กรุณาส่งคำตอบ');
		$('#exam_ready').html('หมดเวลาแล้ว');
	}
	
	$('#time-now').html(Math.floor(isTime/60) + ' นาที ' + (isTime%60) + ' วินาที');
}

function answerChange(lis, qid, ans)
{
	$.ajax({ url: 'ajax_exam.php?load=question',
		data: ({ list: lis, id: qid, change:ans }),
		success: function(data) {
			$('#quest_q'+qid).html(data);
		},
	});
	$.ajax({ url: 'ajax_exam.php?load=answer',
		data: ({ list: lis, id: qid, userid: <?php echo $idUser; ?>, change:ans }),
		success: function(data) {
			$('#answer_q'+qid).html(data);
		},
	});
}

function answerMember(lis, qid, ans)
{
	$.ajax({ url: 'ajax_exam.php?change=answer',
		data: ({ qid: qid, uid: <?php echo $idUser; ?>, aid: ans }),
		error: function() {},
		success: function(data) {
			answerChange(lis, qid, ans);
		},
	});
	
}
if(isTime>0) setInterval("formatTime()", 100);
</script>
</head>
<body>
<?php if($isTime>0): ?>
<h3>เมนู</h3>
<div id="exam_wait">
  <table width="700" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><a href="opt_exam.php">กลับไปหน้าแรก</a></td>
    </tr>
  </table>
  <h3><span id="time-wait">&nbsp;</span></h3>
  <div id="exam_tensec">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="exam_wait">
      <tr>
        <td align="center">เริ่มสอบเวลา
          <?php
		$isStartTime = getdate($isExam['start_date']);
		$isFinsihTime = getdate($isExam['finish_date']);
		if(strlen($isStartTime['hours'])==1) { echo '0'; }
		echo $isStartTime['hours'].'.';
		if(strlen($isStartTime['minutes'])==1) { echo '0'; }
		echo $isStartTime['minutes'].' ถึง ';
		if(strlen($isFinsihTime['hours'])==1) { echo '0'; }
		echo $isFinsihTime['hours'].'.';
		if(strlen($isFinsihTime['minutes'])==1) { echo '0'; }
		echo $isFinsihTime['minutes'].' น.'; 
	?></td>
      </tr>
      <tr>
        <td align="center">ของวันที่ <?php echo ThaiDate::Mid($isExam['start_date']); ?></td>
      </tr>
    </table>
  </div>
  <div id="exam_ready">10</div>
</div>
<div id="exam_do">
  <table width="700" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><span id="exam_save"><a>ส่งคำตอบ</a></span></td>
    </tr>
  </table>
  <h3>เหลือเวลาอีก <span id="time-now"><?php echo floor($isTime/60); ?> นาที <?php echo floor($isTime%60); ?> วินาที</span> ในการทำข้อสอบ</h3>
  <?php
  foreach($database->Query("SELECT * FROM exam_question WHERE exam_id=$_REQUEST[opt];") as $question):
  $aloop=0;
  $userAnswer = $database->Query("SELECT * FROM member_answer WHERE member_id=$idUser AND question_id=$question[question_id] LIMIT 1;");
  ?>
  <div style="border-bottom:#CCC solid 1px; margin-bottom:10px;">
    <div id="quest_q<?php echo $question['question_id']; ?>"><strong><?php echo ($qloop+1); ?>.</strong> <?php echo $question['question']; ?>
    <span onclick="answerChange(<?php echo ($qloop+1); ?>, <?php echo $question['question_id']; ?>, 0);$(this).hide();" id="ans_change">
	<?php if($userAnswer) echo '<a><strong>[เปลี่ยนคำตอบ]</strong></a>'; ?></span>
    </div><div class="exam_answer" id="answer_q<?php echo $question['question_id']; ?>">
      <?php 
	  foreach($database->Query("SELECT * FROM exam_answer WHERE question_id=$question[question_id];") as $answer):
	  if($userAnswer): 
	  if($userAnswer['answer_id']!=$answer['answer_id']): ?>
	  <div style="margin-left:10px;">
		<input class="btn_answered" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>" disabled="disabled" />
	  </div>
	  <?php else: $answer = $database->Query("SELECT * FROM exam_answer WHERE answer_id=$userAnswer[answer_id] LIMIT 1;"); ?>
      <div style="margin-left:10px;">
        <input class="user_answered" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>" disabled="disabled" />
      </div>
	  <?php endif; else: ?>
	  <div style="margin-left:10px;">
		<input class="btn_answer" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>" 
        onclick="answerMember(<?php echo ($qloop+1); ?>, <?php echo $question['question_id']; ?>, <?php echo $answer['answer_id']; ?>)" />
	  </div>
	  <?php endif; ?>
      <?php  $aloop++;  endforeach;?>
  </div></div>
  <?php $qloop++; endforeach; ?>
</div>
<?php else: ?>
<h3>เมนู</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="opt_exam.php">กลับไปหน้าแรก</a></td>
  </tr>
</table>
<h3>ข้อสอบ</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="exam_wait">
  <tr>
    <td align="center">ไม่สามารถทำสอบของวันที่ <?php echo ThaiDate::Mid($isExam['start_date']); ?> ได้</td>
  </tr>
</table>
<?php endif; ?>
</body>
</html>