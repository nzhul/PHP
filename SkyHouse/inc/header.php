<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sky House - ������������� �������������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="stylesheet" href="css/style.css" type="text/css">
<!--[if lte IE 6]><style type="text/css">#ie6suxhard {display: block;}</style><![endif]-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-accordion.js"></script>
<script type="text/javascript" language="javascript">

    function question(){
        var quest = confirm("���� ���� ���� ��� ��������,\n ����� �� � ���� �� ����� ����.\n ������ �� �� ���������� ��� http://twitter.com/nzhul ?");
        if (quest){return true;} else{return false;}
    }
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#two').hide();
		$('#accordion').accordion();
		$("#one_click").click(function () {
			$('#one').slideDown();
			$('#two').slideUp();
    });
	$("#two_click").click(function () {
			$('#one').slideUp();
			$('#two').slideDown();
    });
	$('#index_two').hide();
	$('#index_more').toggle(function(){
		$('#index_two').show();
		$('#index_one').hide();
	},function(){
		$('#index_two').hide();
		$('#index_one').show();
	});

	});
</script>
<script language='javascript'>

function validate_form ()

{

    valid = true;



    if (document.inforequest.name.value == "")

    {

       alert ("���� ��������� ������ '���/�����', �� � ������������!");

        valid = false;

    }

    if (document.inforequest.phone.value == "")

    {

        alert ("���� ��������� ������ '��������� �����', �� � ������������!");

        valid = false;

    }

    if (document.inforequest.comment.value == "")

    {

        alert ("���� ��������� ������ '���������', �� � ������������!");

        valid = false;

    }

    return valid;

}

</script>
</head>
<body>
<div id="ie6suxhard">������ ��, �� ������ <strong>Internet Explorer</strong>(���������� � ����� ��������� � ��������) � �������?<br/>�� �� �������� �������� ���-������� ����������� � ����� ���� �� ������������ �� ��������� ��� ��-���� ������ ��� ���� ��� �������. ������ �� ���-����������� ��� �������� ����� �� ����� �������� ��-����:<br/><a href="http://www.mozilla.com/en-US/firefox/firefox.html"><img src="images/firefox.jpg" /></a><a href="http://www.google.bg/chrome"><img src="images/chrome.jpg" /></a><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx"><img src="images/ie.jpg" /></a><a href="http://www.apple.com/safari/"><img src="images/safari.jpg" /></a><a href="http://www.opera.com/browser/"><img src="images/opera.jpg" /></a><div style="clear:both;">&nbsp;</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.mozilla.com/en-US/firefox/firefox.html">Firefox</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.google.bg/chrome">Google Chrome</a>&nbsp;&nbsp;<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Internet Explorer 8</a>&nbsp;&nbsp;&nbsp;<a href="http://www.apple.com/safari/">Safari</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.opera.com/browser/">Opera</a></div>

