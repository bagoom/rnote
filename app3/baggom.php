<?php

include '../common.php';
header("Content-Type: text/html; charset=UTF-8");


	$json = file_get_contents('php://input');

	 // decoding the received JSON and store into $obj variable.
	$obj = json_decode($json,true);

	
	// same with $password.
	$memberID = $obj['memberID'];
    $wr_subject = $obj['wr_subject'];
    $wr_address = $obj['wr_address'];
    $wr_sale_area = $obj['wr_sale_area'];
    $wr_renter_contact = $obj['wr_renter_contact'];
    $wr_lessor_contact = $obj['wr_lessor_contact'];
    $wr_rec = $obj['wr_rec'];
    $wr_floor = $obj['wr_floor'];
    $wr_area_p = $obj['wr_area_p'];
    $wr_rent_deposit = $obj['wr_rent_deposit'];
    $wr_m_rate = $obj['wr_m_rate'];
    $wr_premium_o = $obj['wr_premium_o'];
    $wr_premium_b = $obj['wr_premium_b'];
    $wr_memo = $obj['wr_memo'];
    $wr_content = $obj['wr_content'];
   

    
    $response = array();
    $response['error'] = 'successfully registered';
    $response['item'] = '';
    
    $sql = "insert into g5_write_test10 set wr_subject = '욜로'";
    $result = sql_query($sql);

//   $sql_query = "INSERT INTO g5_write_$memberID (wr_subject, wr_address, wr_sale_area, wr_renter_contact, wr_lessor_contact, wr_rec_sectors, wr_floor, wr_area_p, wr_rent_deposit, wr_m_rate, wr_premium_o, wr_premium_b, wr_memo, wr_content) VALUES ('$wr_subject', '$wr_address', '$wr_sale_area', '$wr_renter_contact', '$wr_lessor_contact', '$wr_rec', '$wr_floor', '$wr_area_p', '$wr_rent_deposit', '$wr_m_rate', '$wr_premium_o', '$wr_premium_b', '$wr_memo', '$wr_content')";

  $sql_query = "SET sql_mode = ''; INSERT INTO g5_write_$memberID set wr_subject = '$wr_subject'";

//   nsert into $write_table
//   set  wr_o_id 
//   $sql_query = "INSERT INTO g5_write_$memberID set wr_subject, wr_address, wr_sale_area, wr_renter_contact, wr_lessor_contact, wr_rec_sectors, wr_floor, wr_area_p, wr_rent_deposit, wr_m_rate, wr_premium_o, wr_premium_b, wr_memo, wr_content) VALUES ($wr_subject, $wr_address, $wr_sale_area, $wr_renter_contact, $wr_lessor_contact, $wr_rec, $wr_floor, $wr_area_p, $wr_rent_deposit, $wr_m_rate, $wr_premium_o, $wr_premium_b, $wr_memo, $wr_content)";

  
  function checkValidity(){
 

    if(strlen($wr_subject)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_subject';
        return false;
      }

      if(strlen($wr_address)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_address';
        return false;
      } 
      
      if(strlen($wr_sale_area)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_sale_area';
        return false;
      }

      if(strlen($wr_renter_contact)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_renter_contact';
        return false;
      }

      if(strlen($wr_floor)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_floor';
        return false;
      }   

      if(strlen($wr_area_p)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_area_p';
        return false;
      }   

      if(strlen($wr_rent_deposit)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_rent_deposit';
        return false;
      }   

      if(strlen($wr_m_rate)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_m_rate';
        return false;
      }   

      if(strlen($wr_premium_o)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_premium_o';
        return false;
      }   

      if(strlen($wr_premium_b)<=0){
        $response['error'] = true;
        $response['item'] = 'wr_premium_b';
        return false;
      }   
    
    return true;

  }

  if(checkValidity()){
    $result= mysqli_query($con, $sql_query) or die("Error in Selecting " . mysqli_error($con));
    echo json_encode($response);
  }
  else{
    echo json_encode($response);
  }
	


?>
