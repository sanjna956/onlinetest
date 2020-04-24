<?php include('header.php');
$id= base64_decode(urldecode($_GET['id']));
$sql = "SELECT * FROM bk_question WHERE test_id='".$id."' ORDER BY RAND() LIMIT 5";
$res = mysqli_query($db->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
//$total=mysqli_num_rows($res);
//$row = mysqli_fetch_assoc($res);
while($row = mysqli_fetch_assoc($res)){ 
//echo $row['id']."<br>";

}
//echo "<pre>";print_r($row);echo "</pre>"; //die();  
 ?> 
 <link href="css/main.css" rel="stylesheet" type="text/css"/> 
   <script type="text/javascript">
        // Total number of rows visible at a time
        var rowperpage = 1;
        $(document).ready(function(){
			
            getData();  // getting data
            $("#but_prev").click(function(){
                var rowid = Number($("#txt_rowid").val());
                var qsnid = $("input[name='qsnid']").val();
                var allcount = Number($("#txt_allcount").val());
                rowid -= rowperpage;
                if(rowid < 0){
                    rowid = 0;
                }
                $("#txt_rowid").val(rowid);
                getprevData();
            });

            $("#but_next").click(function(){
				var yourans = $("input[name='ans']:checked").val();
				 var unqid="id";
			//	alert(unqid);
				if(yourans != null){
				  //alert('okk');
				    var rowid = Number($("#txt_rowid").val());
                    var allcount = Number($("#txt_allcount").val());
                    var yourans = $("input[name='ans']:checked").val();
                    var numrow=parseInt(rowid)+1;
                    
                    rowid += rowperpage;
                    if(rowid <= allcount){
                   
                        $("#txt_rowid").val(rowid);
                        getData();
                    }
				}
				else{
				    alert('Please Choose The Option');
				    //window.location = "quiz.php";
				}
				
				//alert($("input[name='ans']:checked").val());
				/*if(yourans !==''){
				    
                var rowid = Number($("#txt_rowid").val());
                var allcount = Number($("#txt_allcount").val());
                var yourans = $("input[name='ans']:checked").val();
                var numrow=parseInt(rowid)+1;
                
                rowid += rowperpage;
                if(rowid <= allcount){
               
                    $("#txt_rowid").val(rowid);
                    getData();
                }
				}*/
            });
        });

        /* requesting data */
        function getData(){  		     
            var rowid = $("#txt_rowid").val();
            var allcount = $("#txt_allcount").val();    
            var tid = $("#tid").val(); 
			//alert(rowperpage); 
           // var qsnid = $("input[name='qsnid']").val();
           // var yourans = $("input[name='ans']:checked").val();
            // var numrow=parseInt(rowid)+1;
            // var unqid="id";
			 //data:{rowid:rowid,rowperpage:rowperpage,tid:tid,yourans:yourans,qsnid:qsnid,numrow:numrow,unqid:unqid},
            $.ajax({
                url:'getdata.php',
                type:'post',
                data:{rowid:rowid,rowperpage:rowperpage,tid:tid},
                dataType:'json',
                success:function(response){		
                  //alert(response); 		 		
                   createTablerow(response);
                }
            });

        }
        function getprevData(){ 
            var rowid = $("#txt_rowid").val();
            var allcount = $("#txt_allcount").val();    
            var tid = $("#tid").val(); 
            var qsnid = $("input[name='qsnid']").val();
            var yourans = $("input[name='ans']:checked").val();
             var numrow=parseInt(rowid)+1;
   
            $.ajax({
                url:'getprev.php',
                type:'post',
                data:{rowid:rowid,rowperpage:rowperpage,tid:tid,yourans:yourans,qsnid:qsnid,numrow:numrow},
                dataType:'json',
                success:function(response){
                     createTablerow(response);
                }
            });
           
        }
        /* Create Table */
        function createTablerow(data){
            var dataLen = data.length;            
             if(dataLen==1){
              window.location.href = "http://buddhaiit.com/getresult.php";
             }
           // $(".funkyradio").remove(); 
            // $(".qsncontainer").remove(); 
            for(var i=0; i<dataLen; i++){
                if(i == 0){
                    var allcount = data[i]['allcount'];
					//alert(allcount);
                    //$("#txt_allcount").val(allcount);
                }else{
                    var qnsnum = data[i]['qnsnum'];
                    var id = data[i]['id'];
                    var title = data[i]['title'];
                    var ans1 = data[i]['ans1'];
                    var ans2 = data[i]['ans2'];
                    var ans3 = data[i]['ans3'];
                    var ans4 = data[i]['ans4'];
                    var true_ans = data[i]['true_ans'];
					

                   $(".funkyradio").append("<div class='qsncontainer'><pre> <div class='qsnnum'>1 : Have you read the README file?<input type='hidden' name='qsnid' value='' /></div></pre><div class='mainqsn'><div class='funkyradio-success'><input type='radio' id='1' name='ans' value='' > <label for='1'><div>Yes</div></label></div> <div class='funkyradio-success'><input type='radio' id='2' name='ans' value=''> <label for='2'><div>No</div> </label></div><div class='funkyradio-success'> <input type='radio' id='3' name='ans' value=''><label for='3'><div>Don't want to</div></label></div><div class='funkyradio-success'> <input type='radio' id='4' name='ans' value=''> <label for='4' ><div>Why should I</div> </label> </div></div> <div class='mainqsn imgcontainer'>jkkllilioi</div></div>"); 
				   
                    /*$("#tr_"+i).append("<td class=style2><input type=hidden name=qsnid value='"+id+"' >"+qnsnum+"."+title+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=1>"+ans1+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=2>"+ans2+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=3>"+ans3+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=4>"+ans4+"</td>");*/ 
                }
            }
        } 
    </script>

<!------ Include the above in your HEAD tag ---------->
<nav class="navbar navbar-default title1" style="position: initial;
   ">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li class="active"><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
            <li><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;My History</a></li>
            <li><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Leaderboard</a></li>
         </ul>
      </div>
   </div>
</nav>
<div class="main bg">
   <div class="container"> 
      <div class="row">
         <div class="col-md-12">		
            <div class="panel qsncontainer"> 
					<div class="col-sm-12 quizhead"> 
					<font size="3">Time Left :</font>
					<span class="timer btn btn-default">
					<font style="" id="countdown">2:27</font></span>

					<span class="timer btn btn-primary"  onclick="end()">
					<span class=" glyphicon glyphicon-off"></span> <font style="font-size:12px;font-weight:bold">Finish Quiz</font></span> 
					</div> 
					<form name='myfm' method='post' action='quiz.php' id='cartCheckout'>
<table width="100%" id="emp_table" border="0" >
<tr class="tr_header">

</tr>
</table>
</form>
               <form id="qform" action="" method="POST" class="form-horizontal">
                  <br>
                  <div class="funkyradio">
				    <div class="qsncontainer">
						<pre> 
						<div  class="qsnnum">1 : Have you read the README file?<input type="hidden" name="qsnid" value="" /></div>
						</pre>
				     <div class="mainqsn"> 
                     <div class="funkyradio-success">
                        <input type="radio" id="1" name="ans" value="" > 
                        <label for="1">
                           <div>Yes</div>
                        </label>
                     </div> 
                     <div class="funkyradio-success">
                        <input type="radio" id="2" name="ans" value=""> 
                        <label for="2">
                           <div>No</div>
                        </label>
                     </div>
                     <div class="funkyradio-success">
                        <input type="radio" id="3" name="ans" value=""> 
                        <label for="3">
                           <div>Don't want to</div>
                        </label>
                     </div>
                     <div class="funkyradio-success">
                        <input type="radio" id="4" name="ans" value=""> 
                        <label for="4" >
                           <div>Why should I</div>
                        </label>
                     </div>
                  </div> 
				  <div class="mainqsn imgcontainer">
				     jkkllilioi
				  </div> 
				  </div>
				  </div> 
               </form> 
			     <div class="col-md-12 col-sm-12 quizhead"> 
				<input type="hidden" id="tid" value="<?php echo $id; ?>">
				<input type="hidden" id="txt_rowid" value="0"> 
				<input type="hidden" id="txt_allcount" value="4"> 
                 <a  class="btn btn-primary" style="height:30px" id="but_prev"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true" style="font-size:12px"></span></a>		  
				  <button type="button" class="btn btn-default" onclick="frmreset()" style="height:30px">
				  <font style="font-size:12px;font-weight:bold">Reset</font></button>
				  <a  class="btn btn-primary" style="height:30px" id="but_next"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true" style="font-size:12px"></span></a>
				  </div>
            </div>
			</div>
			<div class="col-sm-12 pagination">
            <div class="" style="text-align:center">
			</div>
			</div>
         
      </div>
   </div>
   <!-- ./container -->
</div>
<?php include_once "footer.php";  ?>

<?php include('header.php');
$id= base64_decode(urldecode($_GET['id']));
$sql = "SELECT * FROM bk_question WHERE test_id='".$id."' ORDER BY RAND() LIMIT 5";
$res = mysqli_query($db->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
//$total=mysqli_num_rows($res);
//$row = mysqli_fetch_assoc($res);
while($row = mysqli_fetch_assoc($res)){ 
//echo $row['id']."<br>";

}
//echo "<pre>";print_r($row);echo "</pre>"; //die();  
 ?> 
 <link href="css/main.css" rel="stylesheet" type="text/css"/> 
   <script type="text/javascript">
        // Total number of rows visible at a time
        var rowperpage = 1;
        $(document).ready(function(){
			
            getData();  // getting data
            $("#but_prev").click(function(){
                var rowid = Number($("#txt_rowid").val());
                var qsnid = $("input[name='qsnid']").val();
                var allcount = Number($("#txt_allcount").val());
                rowid -= rowperpage;
                if(rowid < 0){
                    rowid = 0;
                }
                $("#txt_rowid").val(rowid);
                getprevData();
            });

            $("#but_next").click(function(){
				var yourans = $("input[name='ans']:checked").val();
				 var unqid="id";
			//	alert(unqid);
				if(yourans != null){
				  //alert('okk');
				    var rowid = Number($("#txt_rowid").val());
                    var allcount = Number($("#txt_allcount").val());
                    var yourans = $("input[name='ans']:checked").val();
                    var numrow=parseInt(rowid)+1;
                    
                    rowid += rowperpage;
                    if(rowid <= allcount){
                   
                        $("#txt_rowid").val(rowid);
                        getData();
                    }
				}
				else{
				    alert('Please Choose The Option');
				    //window.location = "quiz.php";
				}
				
				//alert($("input[name='ans']:checked").val());
				/*if(yourans !==''){
				    
                var rowid = Number($("#txt_rowid").val());
                var allcount = Number($("#txt_allcount").val());
                var yourans = $("input[name='ans']:checked").val();
                var numrow=parseInt(rowid)+1;
                
                rowid += rowperpage;
                if(rowid <= allcount){
               
                    $("#txt_rowid").val(rowid);
                    getData();
                }
				}*/
            });
        });

        /* requesting data */
        function getData(){  		     
            var rowid = $("#txt_rowid").val();
            var allcount = $("#txt_allcount").val();    
            var tid = $("#tid").val(); 
			//alert(rowperpage); 
           // var qsnid = $("input[name='qsnid']").val();
           // var yourans = $("input[name='ans']:checked").val();
            // var numrow=parseInt(rowid)+1;
            // var unqid="id";
			 //data:{rowid:rowid,rowperpage:rowperpage,tid:tid,yourans:yourans,qsnid:qsnid,numrow:numrow,unqid:unqid},
            $.ajax({
                url:'getdata.php',
                type:'post',
                data:{rowid:rowid,rowperpage:rowperpage,tid:tid},
                dataType:'json',
                success:function(response){		
                  //alert(response); 		 		
                   createTablerow(response);
                }
            });

        }
        function getprevData(){ 
            var rowid = $("#txt_rowid").val();
            var allcount = $("#txt_allcount").val();    
            var tid = $("#tid").val(); 
            var qsnid = $("input[name='qsnid']").val();
            var yourans = $("input[name='ans']:checked").val();
             var numrow=parseInt(rowid)+1;
   
            $.ajax({
                url:'getprev.php',
                type:'post',
                data:{rowid:rowid,rowperpage:rowperpage,tid:tid,yourans:yourans,qsnid:qsnid,numrow:numrow},
                dataType:'json',
                success:function(response){
                     createTablerow(response);
                }
            });
           
        }
        /* Create Table */
        function createTablerow(data){
            var dataLen = data.length;            
             if(dataLen==1){
              window.location.href = "http://buddhaiit.com/getresult.php";
             }
           // $(".funkyradio").remove(); 
             //$(".qsncontainer").html(); 
            for(var i=0; i<dataLen; i++){
                if(i == 0){
                    var allcount = data[i]['allcount'];
					//alert(allcount);
                    //$("#txt_allcount").val(allcount);
                }else{
                    var qnsnum = data[i]['qnsnum'];
                    var id = data[i]['id'];
                    var title = data[i]['title'];
                    var ans1 = data[i]['ans1'];
                    var ans2 = data[i]['ans2'];
                    var ans3 = data[i]['ans3'];
                    var ans4 = data[i]['ans4'];
                    var true_ans = data[i]['true_ans'];
					

                   $(".funkyradio").append("<div class='qsncontainer'><pre> <div class='qsnnum'>1 : Have you read the README file?<input type='hidden' name='qsnid' value='' /></div></pre><div class='mainqsn'><div class='funkyradio-success'><input type='radio' id='1' name='ans' value='' > <label for='1'><div>Yes</div></label></div> <div class='funkyradio-success'><input type='radio' id='2' name='ans' value=''> <label for='2'><div>No</div> </label></div><div class='funkyradio-success'> <input type='radio' id='3' name='ans' value=''><label for='3'><div>Don't want to</div></label></div><div class='funkyradio-success'> <input type='radio' id='4' name='ans' value=''> <label for='4' ><div>Why should I</div> </label> </div></div> <div class='mainqsn imgcontainer'>jkkllilioi</div></div>"); 
				   
                    $("#tr_"+i).append("<td class=style2><input type=hidden name=qsnid value='"+id+"' >"+qnsnum+"."+title+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=1>"+ans1+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=2>"+ans2+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=3>"+ans3+"</td>");
                    $("#tr_"+i).append("<td class=style8><input type=radio name=ans value=4>"+ans4+"</td>");
                }
            }
        } 
    </script>

<!------ Include the above in your HEAD tag ---------->
<nav class="navbar navbar-default title1" style="position: initial;
   ">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li class="active"><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
            <li><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;My History</a></li>
            <li><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Leaderboard</a></li>
         </ul>
      </div>
   </div>
</nav>
<div class="main bg">
   <div class="container"> 
      <div class="row">
         <div class="col-md-12">		
            <div class="panel qsncontainer"> 
					<div class="col-sm-12 quizhead"> 
					<font size="3">Time Left :</font>
					<span class="timer btn btn-default">
					<font style="" id="countdown">2:27</font></span>

					<span class="timer btn btn-primary"  onclick="end()">
					<span class=" glyphicon glyphicon-off"></span> <font style="font-size:12px;font-weight:bold">Finish Quiz</font></span> 
					</div> 
					<form name='myfm' method='post' action='quiz.php' id='cartCheckout'>
<table width="100%" id="emp_table" border="0" >
<tr class="tr_header">

</tr>
</table>
</form>
               <form id="qform" action="" method="POST" class="form-horizontal">
                  <br>
                  <div class="funkyradio">
				    
				  </div> 
               </form> 
			     <div class="col-md-12 col-sm-12 quizhead"> 
				 <input type="hidden" id="tid" value="<?php echo $id; ?>">
				<input type="hidden" id="txt_rowid" value="0"> 
				<input type="hidden" id="txt_allcount" value="4"> 
                 <a  class="btn btn-primary" style="height:30px" id="but_prev"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true" style="font-size:12px"></span></a>		  
				  <button type="button" class="btn btn-default" onclick="frmreset()" style="height:30px">
				  <font style="font-size:12px;font-weight:bold">Reset</font></button>
				  <a  class="btn btn-primary" style="height:30px" id="but_next"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true" style="font-size:12px"></span></a>
				  </div>
            </div>
			</div>
			<div class="col-sm-12 pagination">
            <div class="" style="text-align:center">
			</div>
			</div>
         
      </div>
   </div>
   <!-- ./container -->
</div>
<?php include_once "footer.php";  ?>