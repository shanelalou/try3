<?php include '../../table.class.php' ?>
<?php header('Access-Control-Allow-Origin: http://gordoncollegeccs.edu.ph/'); ?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Course Enlistment</title>
	<link rel="stylesheet" type="text/css" href="../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<script type="text/javascript" src="flexigrid/flexigrid.pack.js"></script>
	<script type="text/javascript" src="flexigrid/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
			windowHeight = $(window).height() - 330;
			$('#grid').flexigrid({
				url: 'http://gordoncollegeccs.edu.ph/ccswebsite/faculty/class/functions/list.php',
				dataType: 'json',
				buttons: [
					{separator:true},
					
					{name: 'SHOW STUDENTS', bclass: 'add', onpress: function(){
						a = $('.aysem').val() ;b = a.split(',');
						item = $('.trSelected :nth-child(1) > div');
						
						if(item.length == 1){
							ay = b[0]; sem = b[1]; clas = item[0].innerHTML;
							window.location = 'students/?class='+ clas +'&ay='+ ay +'&sem='+ sem;
						}else{
							alert("Select a Class");
						}

					}},
					
					{separator:true},{separator:true},		{separator:true},{separator:true},
					{name: '<a href="../class">CLASS LOADS</a>'} ,
					{separator:true},{separator:true},
			
					{name: '<a href="../logout.php">LOG OUT</a>'} ,
					{separator:true},{separator:true},
					
					
				],
				colModel : [
					{display: 'CLASS CODE', name : 'col', width : 50, align: 'center'},
					{display: 'SUBJECT CODE', name : 'col', width : 70, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'col', width : 240, align: 'center'},
					{display: 'LEC. UNITS', name : 'col', width : 70, align: 'center', hide:true },
					{display: 'LAB. UNITS', name : 'col', width : 70, align: 'center', hide:true},
					{display: 'PREREQUISITE', name : 'col', width : 100, align: 'center', hide:true},
					{display: 'DAY', name : 'col', width : 30, align: 'center'},
					{display: 'START TIME', name : 'col', width : 70, align: 'center'},
					{display: 'END TIME', name : 'col', width : 70, align: 'center'},
					{display: 'ROOM', name : 'col', width : 70, align: 'center'},
					{display: 'STUDENTS', name : 'col', width : 90, align: 'center'},

				],
				searchitems : [
					{display: 'Select Academic Year & Semester', name: ''},
					<?php
						
						$table = new Table();
						$classLoadAYSem = $table->showTable("ay,sem","rclass where instr='".$_SESSION['faculty']."' group by ay,sem order by ay desc,sem desc");
						
						foreach($classLoadAYSem['rows'] as $i){
							echo "{display: '".$i[0]." ".sem('first semester',$i[1])."', name : '".$i[0]." ".sem('first semester',$i[1])."'},\n";
						}
						
					?>
				],
				usepager: true,
				pagestat: 'Displaying {total} Class Loads',
				nomsg: 'No Class Loads',
				title: 'CLASS LOAD : <span>AY: <?php echo enlistment('ay').' '.enlistment('sem') ?></span>',
				height: windowHeight
			});
			
			$('.sDiv2 > select[name=qtype]').change(function(){
				a = $('.sDiv2 > select[name=qtype]').val();b = a.split(" ");
				ay = b[0];sem = "";
				for(i=1; i < b.length; i++){sem += b[i];}
				if(sem=="FirstSemester"){sem="1";}else if(sem=="SecondSemester"){sem="2";}else if(sem=="Summer"){sem="3";}
				$('.aysem').val(ay + "," + sem);
				$('.ftitle').html('CLASS LOAD : <span>AY: ' + $('.sDiv2 > select[name=qtype]').val() + '</span>');
			});
			
			$('.sDiv2 :nth-child(1)').hide();
			$('.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
		});
	</script>
</head>
<body>
		<div class="wraper">
			<div  style="font-size:15px"><?php echo $_SESSION['faculty'] ?> - <?php echo faculty($_SESSION['faculty'],'lastname').', '.faculty($_SESSION['faculty'],'firstname').' '.faculty($_SESSION['faculty'],'middlename').' - '.faculty($_SESSION['faculty'],'position') ?>
			</div>
		</div>

	<div class="page-content">
		<input type="hidden" class="aysem" value="<?php echo enlistment('ay').','.sem('1',enlistment('sem')) ?>">
		<input type="hidden" id="aysem" value="CLASS LOAD : <span>AY: <?php echo enlistment('ay').' '.enlistment('sem') ?></span>">
		<table id="grid"></table>
	</div>
	
</body>
</html>