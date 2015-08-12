<html>
<head>
	<title>test</title>
	<script type="text/javascript">
	function isNumberString(InString,RefString){
		if (InString.length == 0) return false;
		for (Count=0; Count < InString.length; Count++) {
			TempChar = InString.substring(Count,Count+1);
			if (RefString.indexOf(TempChar,0) ==-1) {return false;
			}
		}
    return trun;
}
function check(){
	if (isNumberString(document.checkform.price.value,"1234567890.")!=1) {
		alert("input must be number");
		return false;
	}
}
	</script>

</head>

<body>
  <form name="checkform" action="" method="post">
    price:<input type="text" name="price" value="">
    <input type="submit" name="subbtn" value="submit" onclick="return check()">

  </form>


</body>


</html>