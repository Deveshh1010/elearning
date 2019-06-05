<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<link rel="stylesheet" type="text/css" href="calendar/calendar_css.css"/>
<script src="plugins/jquery.min.js" language="javascript"></script>
<script src="plugins/jquery.fn.js" language="javascript"></script>
<title><?php echo $_REQUEST['title']; ?></title>
</head>
<?php
require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
$choiceAnswer = array('ก','ข','ค','ง');
$user = $database->Query("SELECT * FROM member WHERE member_id=$_REQUEST[userid] LIMIT 1;");
?>
<body>
<h3>ผู้ทำแบบทดสอบคือ 
<?php
if($user['sex']=='F') { echo 'นางสาว'; } else { echo 'นาย'; }
echo $user['firstname'].' '.$user['lastname']; 
?>
</h3>
<?php foreach($database->Query("SELECT * FROM exam_question WHERE exam_id=$_REQUEST[examid];") as $question): ?>
      <div class="chk_question"><div><strong>
	  <?php
	  $userAns = $database->Query("SELECT * FROM member_answer WHERE member_id=$_REQUEST[userid] AND question_id=$question[question_id] LIMIT 1;");
	  if($question['answer_id']==$userAns['answer_id']) {
		  echo '<strong style="color:#090;">[ถูก]</strong> ';
	  } else {
		  echo '<strong style="color:#900;">[ผิด]</strong> ';
	  }
      echo ($qloop+1);
	  ?>.</strong>
	  <?php echo $question['question']; ?></div>
      <div style="margin:5px 0 10px 0;" >
      <?php 
	  $aloop=0;
	  foreach($database->Query("SELECT * FROM exam_answer WHERE question_id=$question[question_id];") as $answer):
	  ?>
        <div style="margin-left:48px;height:18px;">
        <?php
		if($answer['answer_id']==$userAns['answer_id']) { 
			echo '<strong><u>'.$choiceAnswer[$aloop].'. ';
			echo $answer['ans_text'].'</u></strong>';
		} else {
			echo '<strong>'.$choiceAnswer[$aloop].'.</strong> ';
			echo $answer['ans_text'];
		}
		?>
        </div>
 	 <?php $aloop++; endforeach; ?>
      </div></div>
  <?php $qloop++; endforeach; ?>
</body>
</html>