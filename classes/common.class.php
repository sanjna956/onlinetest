<?php 

include "db_config.php";
class Common {
      
	  public $conn;

    public function __construct(){
    $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if(mysqli_connect_errno()) {
     echo "Error: Could not connect to database.";
     exit;
   }
    }
		
function insert($data,$table)
   {
  // print_r($data);
        $query = "INSERT INTO $table (";
		foreach($data as $key=>$val) {
			$query .= $key.", ";       
		}
		$query = substr($query, 0, -2); 
		$query .= ") VALUES ("; 
		foreach($data as $key=>$val) {
			$query .= '"'.$val.'"'.", ";     
		}
		$query = substr($query, 0, -2); 
		$query .= ")";
		//echo $query;
		$insert = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
		if($insert)
		   return true;
		else
		   return false;    
   }  		

 function update($data,$table,$filed_name,$id)
   {
        $query = "UPDATE $table SET ";
		foreach($data as $key=>$val) {
			  $query .= $key."='$val',";       
		}
		//echo $query;
		$query = substr($query, 0, -1); 
		$query .= " WHERE ".$filed_name." = ".$id." ";
		//echo $query;
		$update = mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
		if($update)
		   return true;
		else
		   return false;    
   }  
   
   function delete_records($table,$id)
	  {
	    $query = "DELETE FROM $table WHERE id='".$id."'";
	    $delete =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
		  if($delete)
		    return true;
		  else
		    return false;	
	  }	
	  
	  	function bulk_actions($table,$table_field,$action,$data)
    {
	
	  if($action == "delete")
	     {
		  
		    foreach($data as $key=>$val)
			  {
			    if($table=="bk_product")
				  {
				    $query = "SELECT * FROM bk_product_images WHERE product_id='".$val."'";
					 $get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						 unlink("../product/thumb/".$images['image_name']);
						$query = "DELETE FROM bk_product_images WHERE id='".$images['id']."'";
						 $del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				  else if($table=="bk_ourvision")
				  {
				    $query = "SELECT * FROM bk_ourvision WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../aboutus/".$images['image_name']);
						 unlink("../aboutus/thumb/".$images['image_name']);
						 $query = "DELETE FROM bk_ourvision WHERE id='".$images['id']."'";
						 $del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_ourobjective")
				  {
				    $query = "SELECT * FROM bk_ourobjective WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../aboutus/".$images['image_name']);
						 unlink("../aboutus/thumb/".$images['image_name']);
						$query = "DELETE FROM bk_ourobjective WHERE id='".$images['id']."'";
						$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_aboutus")
				  {
				    $query = "SELECT * FROM bk_aboutus WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../aboutus/".$images['image_name']);
						 unlink("../aboutus/thumb/".$images['image_name']);
						$query = "DELETE FROM bk_aboutus WHERE id='".$images['id']."'";
						$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				     else if($table=="bk_founder_msg")
				  {
				    $query = "SELECT * FROM bk_founder_msg WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../message/".$images['image_name']);
						 unlink("../message/thumb/".$images['image_name']);
						$query = "DELETE FROM bk_founder_msg WHERE id='".$images['id']."'";
						$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				   else if($table=="bk_chairman_msg")
				  {
				    $query = "SELECT * FROM bk_chairman_msg WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../message/".$images['image_name']);
						 unlink("../message/thumb/".$images['image_name']);
					$query = "DELETE FROM bk_chairman_msg WHERE id='".$images['id']."'";
					$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				   else if($table=="bk_secretory_msg")
				  {
				    $query = "SELECT * FROM bk_secretory_msg WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../message/".$images['image_name']);
						  unlink("../message/thumb/".$images['image_name']);
					$query = "DELETE FROM bk_secretory_msg WHERE id='".$images['id']."'";
					$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_committee")
				  {
				    $query = "SELECT * FROM bk_committee WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						 unlink("../product/thumb/".$images['image_name']);
					$query = "DELETE FROM bk_committee WHERE id='".$images['id']."'";
					$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				   else if($table=="bk_ongoing_programme")
				  {
				    $query = "SELECT * FROM bk_ongoing_programme WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../program/".$images['image_name']);
						 unlink("../program/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_ongoing_programme WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_upcoming_programme")
				  {
				    $query = "SELECT * FROM bk_upcoming_programme WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../program/".$images['image_name']);
						 unlink("../program/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_upcoming_programme WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_achievement")
				  {
				    $query = "SELECT * FROM bk_achievement WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						 unlink("../product/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_achievement WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				  
				    else if($table=="bk_award")
				  {
				    $query = mysql_query("SELECT * FROM bk_award WHERE id='".$val."'") or die(mysql_error());
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						  unlink("../product/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_award WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				   else if($table=="bk_media")
				  {
				    $query = "SELECT * FROM bk_media WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						 unlink("../product/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_media WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				  
				   else if($table=="bk_picture")
				  {
				    $query = "SELECT * FROM bk_picture WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../product/".$images['image_name']);
						 unlink("../product/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_picture WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    else if($table=="bk_video")
				  {
				    $query = "SELECT * FROM bk_video WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						
			$query = "DELETE FROM bk_video WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				     else if($table=="bk_latest_news")
				  {
				    $query = "SELECT * FROM bk_latest_news WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../program/".$images['image_name']);
						 unlink("../program/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_latest_news WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				  
				   else if($table=="bk_success_stories")
				  {
				    $query = "SELECT * FROM bk_success_stories WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../program/".$images['image_name']);
						 unlink("../program/thumb/".$images['image_name']);
			$query = "DELETE FROM bk_success_stories WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				    
				   else if($table=="bk_download")
				  {
				    $query = "SELECT * FROM bk_download WHERE id='".$val."'";
					$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($images = mysqli_fetch_assoc($get_images)){
						 unlink("../download/".$images['image_name']);
						 
			$query = "DELETE FROM bk_download WHERE id='".$images['id']."'";
			$del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  }
				  }
				  
				  
				else if($table=="bk_category")
				  {
				    $query = "SELECT id FROM bk_picture WHERE cat_id='".$val."'";
					$get_products =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($products = mysqli_fetch_assoc($get_products)){
							$query ="SELECT * FROM bk_picture WHERE id='".$products['id']."'";
							$get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
							  while($images = mysqli_fetch_assoc($get_images))
							   {
								  unlink("../product/".$images['image_name']);
								  unlink("../product/thumb/".$images['image_name']);
								  $query = "DELETE FROM bk_picture WHERE id='".$images['id']."'";
								  $del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
							   }
						  $query = "DELETE FROM bk_picture WHERE id='".$products['id']."'"; 
						   $delete_product =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 
						}
				 $query = "DELETE FROM bk_sub_category WHERE cat_id='".$val."' ";  
				 $delete_sub_cat =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
				  } 
				  
				  	else if($table=="bk_category_videos")
				  {
				    $query = "SELECT id FROM bk_video WHERE cat_id='".$val."'";
					 $get_products =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($products = mysqli_fetch_assoc($get_products)){
							
					 $query = "DELETE FROM bk_video WHERE id='".$products['id']."'";  
					  $delete_product =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
						}
				 	  
				  } 
				 
				else if($table=="bk_sub_category")
				  {
				    $query = "SELECT id FROM bk_product WHERE sub_cat_id='".$val."'";
					$get_products =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
					  while($products = mysqli_fetch_assoc($get_products)){
							$query = "SELECT * FROM bk_product_images WHERE product_id='".$products['id']."'";
							 $get_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
							  while($images = mysqli_fetch_assoc($get_images))
							   {
								  unlink("../product/".$images['image_name']);
								  unlink("../product/thumb/".$images['image_name']);
						 $query = "DELETE FROM bk_product_images WHERE id='".$images['id']."'";
						 $del_images =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
							   }
						  $query = "DELETE FROM bk_product WHERE id='".$products['id']."'"; 
						  $delete_product =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 
						}
				  }   
			    $query = "DELETE FROM $table WHERE id='".$val."'";
			  $action_completed =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 
			  }
		 }
	  elseif($action == "publish")
	     {
		    foreach($data as $key=>$val)
			  {
			  
			    $query = "UPDATE $table SET $table_field ='publish' WHERE id='".$val."'";
				 $action_completed =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 
				
			  }
		 } 	 
	  elseif($action == "trash" || $action == "block")
	     {
		    foreach($data as $key=>$val)
			  {
			    $query = "UPDATE $table SET $table_field ='block' WHERE id='".$val."'";

			 $action_completed =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 	
			  }
		 } 	
	  elseif($action == "active")
	     {
		    foreach($data as $key=>$val)
			  {
			    $query = "UPDATE $table SET $table_field ='active' WHERE id='".$val."'";
				 $action_completed =	mysqli_query($this->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted"); 
			  }
		 } 	
	  	 	 	 	 
	  if($action_completed)  
		   {
		   return true;
		   }
		else
		  {
		   return false;  
		  } 
	} 	
function check_email($email) {
			$expression = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/";
			if (preg_match($expression, $email)) {
				return true;
			} else {
				return false;
			} 
		}
		
   function generatePassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '123456789';
	}
	if ($strength & 8) {
		$consonants .= '!@#$%&*()+?';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
   }	
   
   function randomvalue() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
    return implode($pass); //turn the array into a string
    }	

 function SiteSetting($field)
	  {
	    $sql = "SELECT $field from bk_site_setting";
		
		 $query = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");

            $result = mysqli_fetch_assoc($query);

		return $result[$field];
	  }
	  
	function GetUserDetails($user)
	  {

	
	  
	     $sql = "SELECT * from bk_users WHERE id='$user'";
		$query = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");

            $result = mysqli_fetch_assoc($query);
		 return $result;
	  }  

	function UserLogin($username,$password)	 
	   {
	  
 $sql = "SELECT id FROM bk_users WHERE email_id='".$username."'";	  
 $check_user = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted"); 
		   if(mysqli_num_rows($check_user))
		     {
			 
		$sql = "SELECT id FROM bk_users WHERE account_status='active' AND email_id='".$username."'";
	   $account_status = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
	   
			     if(mysqli_num_rows($account_status))
				    {
		 $sql = "SELECT id,name,user_role FROM bk_users WHERE email_id='".$username."' AND password='".$password."'";
	   $check_password = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
	
					   if(mysqli_num_rows($check_password))
					    {
						  $user_det = mysqli_fetch_assoc($check_password);
						 
							 if($user_det['user_role']=="admin")
							   {
							     $_SESSION['admin_id'] = $user_det['id'];
								 $_SESSION['admin_name'] = $user_det['name'];
								 $_SESSION['user_role'] = $user_det['user_role'];
								
								 $msg = "true";
							   }
							 else if($user_det['user_role']=="user") 
							   {
							  
							     $_SESSION['user_id'] = $user_det['id'];
								 $_SESSION['user_name'] = $user_det['name'];
								 $_SESSION['user_role'] = $user_det['user_role'];
	$sql = "UPDATE bk_temp_cart SET user_id='".$user_det['id']."' WHERE user_ip='".$_SERVER['REMOTE_ADDR']."'";
	$update_user_id = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
								 $msg = "true";
							   }
						 }
					   else
					     $msg = "Password does not matched.";	 
					}
			     else
				   $msg = "Account is not in Active mode.";
			 }
		 else
		     $msg = "Email-Id does not exists.";	 
			 
			
			return $msg; 
	   }



	function already_added($data,$table,$table_field)
	  {
	    $sql = "SELECT $table_field FROM $table WHERE $table_field='".$data."'";
		$query = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
		
		 if(mysqli_num_rows($query))
		    {
			  return true;
			}	
	  }
	  
	function get_subcat_ajax($category)
	   {
	     $sql = "SELECT id,name FROM bk_sub_category WHERE cat_id='".$category."' AND status='active'";
		 $get_sub_cat = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
		 $num_sub_cat = mysqli_num_rows($get_sub_cat);
		   $data = '<select name="sub_cat" id="sub_cat" class="form-control" onchange="get_sub_sub_cat();">';
		            if($num_sub_cat){
		   $data .= '<option value="">Select Sub Category Name</option>';
		            while($sub_cat = mysqli_fetch_assoc($get_sub_cat)){
		   $data .= '<option value='.$sub_cat['id'].'>'.$sub_cat['name'].'</option>';
		                }
					 } else {
		   $data .= '<option value="">No Sub Category Added in Selected Category</option>';
			         }			 
		   $data .='</select>';
		   
		   echo $data."###".$num_sub_cat;
	   }
	   
	   
	  function get_sub_subcat_ajax($sub_cat,$category)
	   {
	     $sql = "SELECT id,name FROM bk_sup_sub_category WHERE cat_id='".$category."' AND sub_cat_id='".$sub_cat."' AND status='active'";
		  $get_sub_sub_cat = mysqli_query($this->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
		 $num_sub_sub_cat = mysqli_num_rows($get_sub_sub_cat);
		   $data = '<select name="sub_sub_cat" class="form-control"  id="sub_sub_cat">';
		            if($num_sub_sub_cat){
		   $data .= '<option value="">Select Sub Sub Category Name</option>';
		            while($sub_sub_cat = mysqli_fetch_assoc($get_sub_sub_cat)){
		   $data .= '<option value='.$sub_sub_cat['id'].'>'.$sub_sub_cat['name'].'</option>';
		                }
					 } else {
		   $data .= '<option value="">No Sub Sub Category Added in Selected Category</option>';
			         }			 
		   $data .='</select>';
		   
		   echo $data."###".$num_sub_sub_cat;
	   }
	   
	   
	 
	    
		
		}