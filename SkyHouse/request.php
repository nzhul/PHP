<?php
include('inc/header.php');
?>
	<div id="header">
		<div id="empty2">&nbsp;</div>
		<a href="index.php"><img src="images/logo.jpg" alt="������������� �������������" /></a>
		<div id="home" ><a href="index.php">������</a></div>
		<div id="service" ><a href="service.php">������</a></div>
		<div id="question" ><a href="question.php">�������</a></div>
		<div id="request" class="act" ><a href="request.php">���������</a></div>
		<div id="contact"><a href="contact.php">������</a></div>
		<div id="empty">&nbsp;</div>
	</div>
<div id="container">
	<div id="mainframe">
	<div id="pusher">&nbsp;</div>
<div id="content_quest">
	<div id="mail">
		<h3>��������� ��������� �� ���:</h3>
		<form action=sendmail.php method=post name="inforequest" onSubmit="return validate_form ( );">
			<input type="text" class="field1" name="name" value="������ ���" onblur="if(this.value == '') { this.value='������ ���'}" onfocus="if (this.value == '������ ���') {this.value=''}" />
			<input type="text" class="field1" name="phone" value="������ �������" onblur="if(this.value == '') { this.value='������ �������'}" onfocus="if (this.value == '������ �������') {this.value=''}"  />
			<input type="text" class="field1" name="email" value="������ email" onblur="if(this.value == '') { this.value='������ email'}" onfocus="if (this.value == '������ email') {this.value=''}" />
			<textarea class="field2" name="comment" value="������ ���������" rows="5" style="width:320px"></textarea>
			<img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"/>
			<input type="text" class="field1" name="code" value="�������� ���� �� ����������" onblur="if(this.value == '') { this.value='�������� ���� �� ����������'}" onfocus="if (this.value == '�������� ���� �� ����������') {this.value=''}" />
			<label>
                    <input class="more" type="submit" name="Submit" value="�������"> 
                  </label> <input class="more" type="reset" value="�������">
		</form>
	</div>
	</div>
	
<?php
include('inc/footer.php');
?>