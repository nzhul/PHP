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
				<?php
		include("securimage.php");
		$img = new Securimage();
		$valid = $img->check($_POST['code']);
		
	  
	  if( $valid == true) {
	  $to_email="dobromirivanov1@gmail.com";
	  $subject ="Contact Form";
	  $headers.='MIME-Version: 1.0';$headers.="\r\n";
      $headers.='Content-type: text/html; charset=windows-1251';$headers.="\r\n";
	  $headers.="From: dobromirivanov1@gmail.com" . "\r\n";
	  $message.="Name: " . $_POST['name'] . "<br>";
	  $message.="Email: " . $_POST['email'] . "<br>";
	  $message.="Address: " . $_POST['address'] . "<br>";
	  $message.="Phone: " . $_POST['phone'] . "<br>";
	  $message.="Comment: " . $_POST['comment'] . "<br>";
	  mail($to_email, $subject, $message, $headers)
	  ?>
              <p style="text-align: center; width: 450px"><strong>Благодарим Ви! Съобщението беше изпратено успешно!</strong><img align="center" src="images/success.png" alt="success" /></p>
              <?php } else {
	  ?>
              <p style="text-align: center;"><strong>Съжаляваме за неудобството, но имаше проблем с изпращането на Вашето съобщение. Най-вероятно сте въвели <span style="color: red;">НЕВАЛИДЕН</span> код за защита.</strong><img align="center" src="images/error.png" alt="грешка"/></p><p style="text-align: center;"><strong>Моля, опитайте отново</strong> <a href="javascript:history.go(-1)">Назад</a></p>
    <?php } ?>
	</div>
	</div>
	
<?php
include('inc/footer.php');
?>