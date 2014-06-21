<?php
$page_title='widget cost calutator';
include('includes/header.html');
 
function calculate_total($qty,$cost,$tax=5){
  $total = ($qty* $cost);
  $taxrate = ($tax/100);
  $total += ($total * $taxrate);
 //  echo '<p> The total cost of purchasing' .  number_format($total,2) . '.</p>';
  return number_format($total,2);
}

if(isset($_POST['submitted'])){
  if(is_numeric($_POST['quantity'])&&is_numeric($_POST['price'])){
  
  echo '<h1>Total cost</h1>';
  if(is_numeric($_POST['tax'])){
  $sum=calculate_total($_POST['quantity'],$_POST['price'],$_POST['tax']);
  }else{
  $sum=calculate_total($_POST['quantity'],$_POST['price']);
  }
  echo '<p> the total sum is $' . $sum . '</p>';
  //<p>The total cost of purchasing' . $_POST['quantity'] . 'widget(s) at $' . number_format($_POST['price'],2). ' each,including a tax rate of ' . $_POST['tax'] . '%, is $ ' . number_format($total,2) . ' .</p>';
  }else {
  echo '<h1>Error!</h1>
  <p class="error">Please enter a valid quantity,price and tax.</p>';
  }

}
?>


<h1>Widget Cost Calulator</h1>

<form action="calculator.php" method="post">
 <p>Quantity:<input type="text" name="quantity" size="5" maxlength="5" value="<?php if(isset($_POST['quantity'])) echo $_POST['quantity']; ?>" /></p>
 <p>Price:<input type="text" name="price" size="5" maxlength="5" value="<?php if(isset($_POST['price'])) echo $_POST['price']; ?>"/></p>
 <p>tax (%):<input type="text" name="tax" size="5" maxlength="5" value="<?php if(isset($_POST['tax'])) echo $_POST['tax']; ?>"/>(optional)</p>
 <p><input type="submit" name="submit" value="Caculate!" /></p>
 <input type="hidden" name="submitted" value="1"/>
 </form>

 <?php
  include('includes/footer.html');
  ?>
