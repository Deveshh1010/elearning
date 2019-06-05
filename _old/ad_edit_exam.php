<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style_add.css"/>
<link rel="stylesheet" type="text/css" href="calendar/calendar_css.css"/>
<script src="plugins/jquery.min.js" language="javascript"></script>
<script src="plugins/jquery.fn.js" language="javascript"></script>
<title>AOT Extented - โกงข้อสอบ</title>
</head>
<?php
require_once('plugins/connect.mysql.php');
$database = new SyncDatabase();
?>
<script>
$(document).ready(function() {
	var isHour = parseFloat($('#jHour').val());
	var isMinute = parseFloat($('#jMinute').val());
	var isDay = parseFloat($('#jDay').val());
	var isMonth = parseFloat($('#jMonth').val());
	var isYear = parseFloat($('#jYear').val());
	$('#month_today').caleDay(isHour, isMinute, isDay, isMonth, isYear);
	
	function setCurrentDate() {
		$('#jHour').val(isHour);
		$('#jMinute').val(isMinute);
		$('#jDay').val(isDay);
		$('#jMonth').val(isMonth);
		$('#jYear').val(isYear);
	}
	function getCurrentDate() {
		isHour = parseFloat($('#jHour').val());
		isMinute = parseFloat($('#jMinute').val());
		isDay = parseFloat($('#jDay').val());
		isMonth = parseFloat($('#jMonth').val());
		isYear = parseFloat($('#jYear').val());
	}
	
	$('#nextMonth').click(function() {
		getCurrentDate();
		$('#month_today').animate({
			opacity: 0,
			left: '-=20',
		},200,function() {
			if($('#mChange').val()==0) {
				isDay = $('#jDay').val();
				isMonth += 1;
				if(isMonth>12) { isMonth = 1; isYear += 1;}
				setCurrentDate();
				$('#month_today').caleDay($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
			} else {
				isDay = $('#jDay').val();
				isYear += 1;
				setCurrentDate();
				$('#month_today').caleMonth($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
			}
			// Show Animate
			$('#month_today').animate({
				opacity: 0,
				left: '+=40',
			},0,function() {
				$('#month_today').animate({
					opacity: 1,
					left: '-=20',
				},200);
			});
		});
	});
	
	$('#backMonth').click(function() {
		getCurrentDate();
		$('#month_today').animate({
			opacity: 0,
			left: '+=20',
		},200,function() {
			if($('#mChange').val()==0) {
				isDay = $('#jDay').val();
				isMonth -= 1;
				if(isMonth<1) { isMonth = 12; isYear -= 1;}
				setCurrentDate();
				$('#month_today').caleDay($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
			} else {
				isDay = $('#jDay').val();
				isYear -= 1;
				setCurrentDate();
				$('#month_today').caleMonth($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
			}
			// Show Animate
			$('#month_today').animate({
				opacity: 0,
				left: '-=40',
			},0,function() {
				$('#month_today').animate({
					opacity: 1,
					left: '+=20',
				},200);
			});
		});
	});
	

	$('#isMonthName').click(function() {
		$('#mChange').val(1);
		$('#month_today').animate({
			opacity: 0,
			top: '+=20',
		},200,function() {
			$('#month_today').caleMonth($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
			$('#isMonthName').attr('disabled','disabled');			
			// Show Animate
			$('#month_today').animate({
				opacity: 0,
				top: '-=40',
			},0,function() {
				$('#month_today').animate({
					opacity: 1,
					top: '+=20',
				},200,function() {
		
				});
			});
		});
	});
	
	$('#signup_year').click(function(){
		$('#calendarview').fadeIn();
	});	
	
	$('#jHour').change(function(){
		$('#month_today').caleDay($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
	});	
	
	$('#jMinute').change(function(){
		$('#month_today').caleDay($('#jHour').val(), $('#jMinute').val(), $('#jDay').val(), $('#jMonth').val(), $('#jYear').val());
	});
		
	$('#jTime').bind({
		focusin: function() {
			if(parseFloat($(this).val())<=0) {
				$(this).val('');
			}
		},
		keyup: function() {
			if($(this).val()>0) {
				$('#timestamp_end').val((parseFloat($('#jTime').val())*60)+parseFloat($('#timestamp_signup').val()));
			} else {
				$('#timestamp_end').val(parseFloat($('#timestamp_signup').val()));
			}
		},
		keydown: function() {
			if($(this).val()>0) {
				$('#timestamp_end').val((parseFloat($('#jTime').val())*60)+parseFloat($('#timestamp_signup').val()));
			} else {
				$('#timestamp_end').val(parseFloat($('#timestamp_signup').val()));
			}
		}
	});
	$('#exam_save').click(function() {
		$(this).html('<strong>กำลังบันทึก... </strong>| ');
		$.ajax({ url: 'ajax_exam.php?update=exam',
			data: ({ id: <?php echo $_REQUEST['id']; ?>, unitid: $('#unit').val(), started: $('#timestamp_signup').val(), finished: $('#timestamp_end').val(), type: $("input[@name=type]:checked").val() }),
			dataType: "json",
			error: function() {
				alert('Error: answer=change');
			},
			success: function(data) {
				window.location = "ad_exam.php";
			},
		});
	});	
});

function examEdit(type, id, text)
{
	$.ajax({ url: 'ajax_exam.php?update=' + type,
		data: ({ id: id, text: text }),
		dataType: "json",
		type: "POST",
		error: function() {},
		success: function(data) {},
	});
}
</script>
<?php
$exam = $database->Query("SELECT * FROM exam WHERE exam_id=$_REQUEST[id] LIMIT 1;");
$isStartTime = getdate($exam['start_date']);
$isFinsihTime = getdate($exam['finish_date']);
$examTime = ((($isFinsihTime['hours']*60)+$isFinsihTime['minutes']) - (($isStartTime['hours']*60)+$isStartTime['minutes']))
?>
<body onload="<?php if($exam['type']=='T') echo "$('#view_datetime').hide();"; ?>">
<h3>จัดการข้อสอบ</h3>
<table width="700" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><span id="exam_save"><a>บันทึกข้อสอบ</a> | </span><a href="ad_exam.php">กลับไปหน้าจัดการข้อสอบ</a></td>
  </tr>
</table>
<h3>แก้ไขข้อสอบ</h3>
<div style="padding:5px">ประเภทข้อสอบ
<label><input type="radio" name="type" value="E" onclick="$('#view_datetime').show();" <?php if($exam['type']=='E') echo 'checked="checked"'; ?>/> ข้อสอบ</label>
<label><input type="radio" name="type" value="T" onclick="$('#view_datetime').hide();" <?php if($exam['type']=='T') echo 'checked="checked"'; ?>/> แบบทดสอบ</label>
</div>
<div style="padding:5px;">รายละเอียดข้อสอบ
  <select id="unit">
    <?php foreach($database->Query("SELECT * FROM lesson_unit;") as $unit): ?>
    <option <?php if($exam['unit_id']==$unit['unit_id']) echo 'selected="selected"'; ?> value="<?php echo $unit['unit_id']; ?>">หน่วยการเรียนรู้ที่ <?php echo $unit['unit_id'].' '.$unit['unit_name']; ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div id="view_datetime">
<div style="padding:5px;">วันที่สอบ
  <input type="button" id="signup_year" value="" />
  <input type="hidden" name="timestamp_start" id="timestamp_signup" />
  <input type="hidden" name="timestamp_finish" id="timestamp_end" />
</div>
<div id="calendarview" style="display:none; position:absolute; background-color:#FFF; margin:-7px 0 0 50px;">
  <div id="calendar-frame">
    <table id="calendar" width="168" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td><input id="backMonth" type="button" value="&lt;" /></td>
        <td><input id="isMonthName" type="button" value=" " /></td>
        <td><input id="nextMonth" type="button" value="&gt;" /></td>
      </tr>
      <tr>
        <td colspan="3" style="height:7px"><input type="hidden" id="mChange" value="0" />
          <input type="hidden" id="jDay" value="<?php echo $isStartTime['mday']; ?>" />
          <input type="hidden" id="jMonth" value="<?php echo $isStartTime['mon']; ?>" />
          <input type="hidden" id="jYear" value="<?php echo $isStartTime['year']; ?>" /></td>
      </tr>
      <tr>
        <td colspan="3"><div id="month_today"></div></td>
      </tr>
    </table>
  </div>
</div>
<div style="padding:5px;">เริ่มสอบเวลา
  <select id="jHour">
    <?php for($mloop=0;$mloop<24;$mloop++): ?>
    <option <?php if($mloop==$isStartTime['hours']) echo 'selected="selected"'; ?> value="<?php echo $mloop; ?>"><?php echo $mloop; ?></option>
    <?php endfor; ?>
  </select>
  :
  <select id="jMinute">
    <?php for($sloop=0;$sloop<60;$sloop++): ?>
    <option <?php if($sloop==$isStartTime['minutes']) echo 'selected="selected"'; ?> value="<?php echo $sloop; ?>"><?php echo $sloop; ?></option>
    <?php endfor; ?>
  </select>
  น. ใช้เวลาสอบ
  <input type="text" value="<?php echo $examTime; ?>" maxlength="5" id="jTime" />
  นาที</div></div>
  <?php foreach($database->Query("SELECT * FROM exam_question WHERE exam_id=$_REQUEST[id];") as $question): ?>
      <div class="question"><div><strong><?php echo ($qloop+1); ?>.</strong> 
      <input type="text" class="quest_text" name="<?php echo $question['question_id']; ?>" value="<?php echo $question['question']; ?>"
       onkeyup="examEdit('quest', $(this).attr('name'), $(this).val())" onchange="examEdit('quest', $(this).attr('name'), $(this).val())" /></div>
      <div class="answer">
      <?php foreach($database->Query("SELECT * FROM exam_answer WHERE question_id=$question[question_id];") as $answer): ?>
        <div style="margin-left:20px;">
        <label><input type="radio" name="<?php echo $question['question_id']; ?>" value="<?php echo $answer['answer_id']; ?>"
        <?php if($question['answer_id']==$answer['answer_id']) { echo 'checked="checked"'; } ?> onclick="examEdit('radio', $(this).attr('name'), $(this).val())" /> </label>
        <input type="text" class="ans_text" name="<?php echo $answer['answer_id']; ?>" value="<?php echo $answer['ans_text']; ?>"
         onkeyup="examEdit('ans', $(this).attr('name'), $(this).val())" onchange="examEdit('ans',$(this).attr('name'), $(this).val())" />
        </div>
 	 <?php endforeach; ?>
      </div></div>
  <?php $qloop++; endforeach; ?>
</body>
</html>