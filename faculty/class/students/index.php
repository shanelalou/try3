<?php include '../../../config.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Enlistment</title>
	<link rel="stylesheet" type="text/css" href="../../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../../source/styles/style.css">
	<script type="text/javascript" src="../../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
		
			windowHeight = $(window).height() - 330;
			
			$('#grid').flexigrid({
				url: 'functions/list.php?class=<?php echo $_GET['class']?>&ay=<?php echo $_GET['ay']?>&sem=<?php echo $_GET['sem']?>',
				dataType: 'json',
				buttons: [
					<?php if($_GET['ay']==enlistment('ay') and $_GET['sem']==sem('1',enlistment('sem'))){ ?>
					<?php } ?>
		
					{name: '<a href="../index.php">CLASS LOADS</a>'} ,
					{separator:true},{separator:true},
			
					{name: '<a href="../../logout.php">LOG OUT</a>'} ,
					{separator:true},{separator:true},
				],
				colModel : [
					{display: 'STUDENT NUMBER', name : 'col', width : 100, align: 'center'},
					{display: 'NAME', name : 'col', width : 240, align: 'left'},
					{display: 'COURSE', name : 'col', width : 110, align: 'center', hide: true },
					{display: 'CURRICULUM', name : 'col', width : 120, align: 'center', hide: true },
					{display: 'YEAR LEVEL', name : 'col', width : 130, align: 'center', hide: true },
					{display: 'PRELIM', name : 'col', width : 60, align: 'left'},
					{display: 'P. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'MIDTERM', name : 'col', width : 60, align: 'left'},
					{display: 'M. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'FINAL', name : 'col', width : 60, align: 'left'},
					{display: 'F. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'EQUIV.', name : 'col', width : 70, align: 'left'},
					{display: 'REMARKS', name : 'col', width : 160, align: 'left'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Displaying {total} Students',
				nomsg: 'No student on list.',
				title: 'CLASS STUDENTS : <span><?php echo $_GET['class'] ?></span>',
				height: windowHeight
			});
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
		
			setInterval(function(){
				item = $('tbody > tr :nth-child(13) > div');
				$.each(item,function(i){
					if(item[i].innerHTML=="Passed"){
						$(item[i]).css('color','green');
					}else{
						$(item[i]).css('color','red');
					}
				});
			},1);
		});
	</script>
</head>
<body>


	<div class="title">
		<div class="wraper">
			<div  style="font-size:15px"><?php echo $_SESSION['faculty'] ?> - <?php echo faculty($_SESSION['faculty'],'lastname').', '.faculty($_SESSION['faculty'],'firstname').' '.faculty($_SESSION['faculty'],'middlename').' - '.faculty($_SESSION['faculty'],'position') ?></div>
		</div>
	</div>

	<div class="page-content"><table id="grid"></table></div>
	
	
</body>
</html>