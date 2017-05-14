<?php
include('inc/header.php');
?>
	<div id="header">
		<div id="empty2">&nbsp;</div>
		<a href="index.php"><img src="images/logo.jpg" alt="професионален домоуправител" /></a>
		<div id="home" ><a href="index.php">Начало</a></div>
		<div id="service" ><a href="service.php">Услуги</a></div>
		<div id="question" ><a href="question.php">Въпроси</a></div>
		<div id="request" class="act" ><a href="request.php">Запитване</a></div>
		<div id="contact"><a href="contact.php">Връзка</a></div>
		<div id="empty">&nbsp;</div>
	</div>
<div id="container">
	<div id="mainframe">
	<div id="pusher">&nbsp;</div>
<div id="content_quest">
	<div id="mail">
		<h3>Изпратете запитване от тук:</h3>
		<form action=sendmail.php method=post name="inforequest" onSubmit="return validate_form ( );">
			<input type="text" class="field1" name="name" value="Вашето име" onblur="if(this.value == '') { this.value='Вашето име'}" onfocus="if (this.value == 'Вашето име') {this.value=''}" />
			<input type="text" class="field1" name="phone" value="Вашият телефон" onblur="if(this.value == '') { this.value='Вашият телефон'}" onfocus="if (this.value == 'Вашият телефон') {this.value=''}"  />
			<input type="text" class="field1" name="email" value="Вашият email" onblur="if(this.value == '') { this.value='Вашият email'}" onfocus="if (this.value == 'Вашият email') {this.value=''}" />
			<textarea class="field2" name="comment" value="Вашето съобщение" rows="5" style="width:320px"></textarea>
			<img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"/>
			<input type="text" class="field1" name="code" value="Въведете кода от картинката" onblur="if(this.value == '') { this.value='Въведете кода от картинката'}" onfocus="if (this.value == 'Въведете кода от картинката') {this.value=''}" />
			<label>
                    <input class="more" type="submit" name="Submit" value="Изпрати"> 
                  </label> <input class="more" type="reset" value="Изчисти">
		</form>
	</div>
	</div>
	
<?php
include('inc/footer.php');
?>