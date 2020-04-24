<?php
include("../connection.php"); 

if($_REQUEST['subview']=="general")
   {
       $up_down = mysql_real_escape_string($_POST['up_down']);
	   $title = mysql_real_escape_string($_POST['title']);
	   $meta_description = mysql_real_escape_string($_POST['meta_description']);
	   $meta_keyword = mysql_real_escape_string($_POST['meta_keyword']);
	   $email_id = mysql_real_escape_string($_POST['email_id']);
	     $email_id1 = mysql_real_escape_string($_POST['email_id1']);
	   
	   $contact_no = mysql_real_escape_string($_POST['contact_no']);
	    $contact_no1 = mysql_real_escape_string($_POST['contact_no1']);
		 $contact_no2 = mysql_real_escape_string($_POST['contact_no2']);
		 
	   $listing = mysql_real_escape_string($_POST['listing']);  
	   $purchase_quantity = mysql_real_escape_string($_POST['quant']); 
	    $url = mysql_real_escape_string($_POST['url']);  
	   $purchase_time = $_POST['time'];	
	   $am_pm = $_POST['am_pm'];
	   
		$data = array("up_down"=>$up_down, 
				   "meta_title"=>$title,
				   "meta_description"=>$meta_description,
				   "meta_keyword"=>$meta_keyword,
				   "email_id"=>$email_id,
				    "email_id1"=>$email_id1,
				   "contact_no"=>$contact_no,
				   "contact_no1"=>$contact_no1,
				   "contact_no2"=>$contact_no2,
				   
				   "page_listing"=>$listing,
				   "purchase_quantity"=>$purchase_quantity,
				   "url"=>$url
		 );
		 
		 $update_email = mysql_query("UPDATE bk_users SET email_id='".$email_id."', name='".$title."' WHERE id='".$_SESSION['admin_id']."' AND user_role='admin'") or die(mysql_error());
		 $select_record = mysql_query("SELECT id FROM bk_site_setting") or die(mysql_error());
         if(mysql_num_rows($select_record))
         {
		   $added_data = mysql_fetch_assoc($select_record);
		   $field ="id";	 
		   if($db->update($data,'bk_site_setting',$field,1) == true)  
			{
			    if($_FILES['logo']['name']!="")
					 {
					   unlink("../product/".$added_data['logo']);
					   $last_id = mysql_insert_id();
					   $logo = $_FILES['logo']['name'];
					   $exp = explode(".",$logo);
					   $extension = end($exp);
					   
					   $logo_name = "logo".".".$extension;
					   
					   $upload = move_uploaded_file($_FILES['logo']['tmp_name'],"../product/".$logo_name);
						if($upload)
						  {
							$update_logo = mysql_query("UPDATE bk_site_setting SET logo='".$logo_name."' WHERE id='1'") or die(mysql_error());
						  }
					 }
			   $_SESSION['site_setting'] ="Record Update SuccessFully.";
			}
		  else
		    {
			$_SESSION['site_setting'] ="Record couldn't be updated.Please try again.";
			}	
			 
		 }
		 else {	 
				  if($db->insert($data,'bk_site_setting') == true)  
					{
					   if($_FILES['logo']['name']!="")
						 {
						   $last_id = mysql_insert_id();
						   $logo = $_FILES['logo']['name'];
						   $exp = explode(".",$logo);
						   $extension = end($exp);
						   
						   $logo_name = "logo".".".$extension;
						   
							$upload = move_uploaded_file($_FILES['logo']['tmp_name'],"../product/".$logo_name);
							if($upload)
							  {
								$update_logo = mysql_query("UPDATE bk_website_setting SETlogo='".$logo_name."' WHERE id='".$last_id."'") or die(mysql_error());
							  }
						 }
					$_SESSION['site_setting'] ="Record Added Success Fully.";
					}
				  else
					{
					$_SESSION['site_setting1'] ="Record couldn't be added.Please try again.";
					}	
			}		
	  echo "<script>window.location.href='../website_setting.php?subview=general'</script>"; 	  		
   }
   
  if($_REQUEST['subview']=="social")
   {
     $facebook = mysql_real_escape_string($_POST['facebook']);
	 $twitter = mysql_real_escape_string($_POST['twitter']); 
	  $youtube = mysql_real_escape_string($_POST['youtube']); 
	   $google = mysql_real_escape_string($_POST['google']);  
	 
	 
     $data = array("facebook"=>$facebook,"twitter"=>$twitter,"youtube"=>$youtube,"google"=>$google);
	 $field ="id";	 
	 $id = 1;
		  if($db->update($data,'bk_site_setting',$field,$id) == true)  
			{
			$_SESSION['site_setting'] ="Record Added Success Fully.";
			}
		  else
		    {
			$_SESSION['site_setting1'] ="Record couldn't be updated.Please try again.";
			}	
	  echo "<script>window.location.href='../website_setting.php?subview=social'</script>"; 	   	  		
   } 
   
  if($_REQUEST['subview']=="track")
   {
     $track = mysql_real_escape_string($_POST['track']);
	 
	 
	 
     $data = array("track"=>$track);
	 $field ="id";	 
	 $id = 1;
		  if($db->update($data,'bk_site_setting',$field,$id) == true)  
			{
			$_SESSION['site_setting'] ="Record Added Success Fully.";
			}
		  else
		    {
			$_SESSION['site_setting1'] ="Record couldn't be updated.Please try again.";
			}	
	  echo "<script>window.location.href='../website_setting.php?subview=track'</script>"; 	   	  		
   }  
   
   
   
  