<?php

  class Front_End extends Common{
  
    public $typeArray = array();
	public $subcatArray = array();
	public $catArray = array();
    public $subsubcatArray = array();
	 public $manufacturerArray = array();
	
     function CheckUserExist($email)
	   {
			 $sql = "SELECT email_id FROM bk_users WHERE email_id='".trim($email)."'";
			 
			  $get_email = mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot inserted");

             if(mysqli_num_rows($get_email))
	
			   {
				 echo "<font color=\"red\">
								&nbsp;&nbsp;Email-Id Already Used.
							</font>";
			   }
			else
			  echo " "; 
		 
	   }
	   
	   
	   }