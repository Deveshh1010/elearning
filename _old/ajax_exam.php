<?php require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
if($_REQUEST['ans_show']=='change') {
	$database->Query("UPDATE exam SET show_ans=$_REQUEST[show] WHERE exam_id=$_REQUEST[id];");
}
if($_REQUEST['update']=='exam') {
	sleep(1);
	$result = $database->Query("UPDATE exam SET unit_id=$_REQUEST[unitid], start_date=$_REQUEST[started], finish_date=$_REQUEST[finished], type='$_REQUEST[type]' WHERE exam_id=$_REQUEST[id];");
	echo json_encode(array('success'=>$result));
} elseif($_REQUEST['update']=='quest') {
	$result = $database->Query("UPDATE exam_question SET question='$_REQUEST[text]' WHERE question_id=$_REQUEST[id];");
	echo json_encode(array('success'=>$result));
} elseif($_REQUEST['update']=='radio') {
	$result = $database->Query("UPDATE exam_question SET answer_id=$_REQUEST[text] WHERE question_id=$_REQUEST[id];");
	echo json_encode(array('success'=>$result));
} elseif($_REQUEST['update']=='ans') {
	$result = $database->Query("UPDATE exam_answer SET ans_text='$_REQUEST[text]' WHERE answer_id=$_REQUEST[id];");
	echo json_encode(array('success'=>$result));
}

if($_REQUEST['created']=='exam') {
	sleep(1);
	$showAnswer = 0;
	if($_REQUEST['type']=='T') { $showAnswer = 1; }
	$exam_id = $database->Query("INSERT INTO exam (unit_id, start_date, finish_date, show_ans, type) VALUES ($_REQUEST[unitid], $_REQUEST[started], $_REQUEST[finished], $showAnswer, '$_REQUEST[type]');");
	for($qloop=0;$qloop<10;$qloop++) {
		$question_id = $database->Query("INSERT INTO exam_question (exam_id) VALUES ($exam_id);");
		for($aloop=0;$aloop<4;$aloop++) {
			$database->Query("INSERT INTO exam_answer (question_id) VALUES ($question_id);");
		}
	}
	echo json_encode(array('id'=>$exam_id));
}
if($_REQUEST['del']=='exam' && isset($_REQUEST['id'])) {
	foreach($database->Query("SELECT * FROM exam_question WHERE exam_id=$_REQUEST[id];") as $question) {
		$database->Query("DELETE FROM exam_answer WHERE question_id=$question[question_id];");
	}
	$database->Query("DELETE FROM exam_question WHERE exam_id=$_REQUEST[id];");
	$database->Query("DELETE FROM exam WHERE exam_id=$_REQUEST[id];");
	echo json_encode(array('success'=>$result));
}
if($_REQUEST['load']=='answer') {
	$choiceAnswer = array('ก','ข','ค','ง');
	$aloop=0;
	$userAnswer = $database->Query("SELECT * FROM member_answer WHERE member_id=$_REQUEST[userid] AND question_id=$_REQUEST[id] LIMIT 1;");
	if(!$_REQUEST['change']) { $userAnswer = NULL; }
	foreach($database->Query("SELECT * FROM exam_answer WHERE question_id=$_REQUEST[id];") as $answer) {
		if($userAnswer) {
			if($userAnswer['answer_id']!=$answer['answer_id']) { ?>
                <div style="margin-left:10px;">
                  <input class="btn_answered" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>" disabled="disabled" />
                </div><?php 
			} else {
				$answer = $database->Query("SELECT * FROM exam_answer WHERE answer_id=$userAnswer[answer_id] LIMIT 1;"); ?>
                <div style="margin-left:10px;">
                  <input class="user_answered" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>" disabled="disabled" />
                </div><?php
			}
		} else { ?>
			<div style="margin-left:10px;">
              <input class="btn_answer" type="button" value="<?php echo $choiceAnswer[$aloop].'. '.$answer['ans_text']; ?>"
              onclick="answerMember(<?php echo $_REQUEST['list']; ?>, <?php echo $_REQUEST['id']; ?>, <?php echo $answer['answer_id']; ?>)" />
			</div>
			<?php
		}
		$aloop++;
	}
} elseif($_REQUEST['load']=='question') {	
	$question = $database->Query("SELECT * FROM exam_question WHERE question_id=$_REQUEST[id] LIMIT 1;"); ?>
	<strong><?php echo $_REQUEST['list']; ?>.</strong> <?php echo $question['question']; ?>
    <span onclick="answerChange(<?php echo $_REQUEST['list']; ?>, <?php echo $_REQUEST['id']; ?>, 0);$(this).hide();" id="ans_change">
	<?php if($_REQUEST['change']!=0) echo '<a><strong>[เปลี่ยนคำตอบ]</strong></a>'; ?></span><?
}

if($_REQUEST['change']=='answer') {
	if(!$database->Query("SELECT * FROM member_answer WHERE member_id=$_REQUEST[uid] AND question_id=$_REQUEST[qid] LIMIT 1;")) {
		$database->Query("INSERT INTO member_answer (member_id, question_id, answer_id) VALUES ($_REQUEST[uid], $_REQUEST[qid], $_REQUEST[aid])");
	} else {
		$database->Query("UPDATE member_answer SET answer_id=$_REQUEST[aid] WHERE member_id=$_REQUEST[uid] AND question_id=$_REQUEST[qid];");
	}
}

?>