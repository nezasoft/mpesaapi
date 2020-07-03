<?php
include('../connect/index.php');
header("Content-Type:application/json");
/*if (!isset($_GET["token"])){
echo "Technical error";
exit();
}
file_put_contents('log.txt',$_GET['token'],FILE_APPEND | LOCK_EX);
file_put_contents('log.txt', "\n", FILE_APPEND);

$password="KMp8TvJUnugjVT9h";
if($_GET["token"]!=$password){
echo "Invalid authorization";
exit();
}
*/
if (!$request=file_get_contents('php://input')){
echo "Invalid input";
exit();
}

//Put the json string that we received from Safaricom to an array
$array = json_decode($request, true);
$transactiontype= $array['TransactionType']; 
$transid=$array['TransID']; 
$transtime= $array['TransTime']; 
$transamount= $array['TransAmount']; 
$businessshortcode= $array['BusinessShortCode']; 
$billrefno= $array['BillRefNumber']; 
$invoiceno= $array['InvoiceNumber']; 
$msisdn= $array['MSISDN']; 
$orgaccountbalance= $array['OrgAccountBalance']; 
$firstname=$array['FirstName']; 
$middlename=$array['MiddleName']; 
$lastname=$array['LastName']; 
 
$sql=$conn->prepare("INSERT INTO transactions(TransactionType,TransID,TransTime,TransAmount,BusinessShortCode,BillRefNumber,InvoiceNumber,MSISDN,FirstName,MiddleName,LastName,OrgAccountBalance) VALUES( 
'".$transactiontype."', '".$transid."', '".$transtime."','".$transamount."','".$businessshortcode."','".$billrefno."','".$invoiceno."','".$msisdn."','".$firstname."','".$middlename."','".$lastname."','".$orgaccountbalance."')");
$sql->execute();
$row_count = $sql->rowCount();

if($row_count>=1){
echo '{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
}

?>
