<?php 
include('header.php');
if(!isset($_SESSION['loginuser'])){
	header("Location:".URL); 
}
if(!isset($_SESSION['loginuser'])){
	header("Location:".URL); 
}
$id= base64_decode(urldecode($_GET['id']));
$sql = "SELECT dis_qsnnum,totaltime FROM bk_test WHERE id='".$id."'";
$res = mysqli_query($db->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
$row = mysqli_fetch_array($res);
$disqsnnum=$row['dis_qsnnum'];
$totaltime=$row['totaltime'];
//echo "<pre>";print_r($row['dis_qsnnum']);echo "</pre>"; //die();  
?> 
 <link href="css/main.css" rel="stylesheet" type="text/css"/> 
   <script type="text/javascript">
        var rowperpage = 1;
        $(document).ready(function(){			
            getData();
			//checkData(); 
            $("#but_next").click(function(){
				var yourans = $("input[name='ans']:checked").val();
				if(yourans != null){
				    var rowid = Number($("#txt_rowid").val());					 
                    var allcount = Number($("#txt_allcount").val());
                    var numrow=parseInt(rowid)+1;
                    rowid += rowperpage;
                    if(rowid <= allcount+1){ 
                        $("#txt_rowid").val(rowid);
                        getData();
                    }
					if(rowid==allcount+1){
						 window.location.href = "<?php echo URL; ?>account.php?msg=1";
					} 
				}
				else{ 
				    alert('Please Choose The Option');
				}
            });
			$("#but_prev").click(function(){
				    var yourans = $("input[name='ans']:checked").val();
				    var rowid = Number($("#txt_rowid").val());					 
                    var allcount = Number($("#txt_allcount").val());
                    var numrow=parseInt(rowid)+1;
                    rowid += rowperpage;
                    if(rowid <= allcount+1){ 
                        $("#txt_rowid").val(rowid);
                        getData();
                    }
					if(rowid==allcount+1){
						 window.location.href = "<?php echo URL; ?>account.php?msg=1";
					}  
			  //getprevData();
			});
        });
        /* requesting data */
        function getData(){   		
            var rowid = $("#txt_rowid").val();
            var allcount = $("#txt_allcount").val();    
            var tid = $("#tid").val();  
            var qsnid = $("input[name='qsnid']").val();
            var yourans = $("input[name='ans']:checked").val();
            var numrow=parseInt(rowid)+1;
            $.ajax({ 
                url:'getdata.php',
                type:'post',
                data:{rowid:rowid,rowperpage:rowperpage,tid:tid,yourans:yourans,qsnid:qsnid,numrow:numrow},
               dataType:'json',
                success:function(response){				   
                   createTablerow(response);
                }
            }); 
        }
		function checkData(){   		    
            var tid = $("#tid").val();  
            $.ajax({ 
                url:'test.php',
                type:'post',
                data:{tid:tid},	
                success:function(response){		
                  if(response==0){
					// alert(response);  
				  }else{
					// alert(response);  
				  }
                  
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
            $("#emp_table tr:not(:first)").remove();
            for(var i=0; i<dataLen; i++){
				 var image = data[i]['image']; 
				 if(image!=''){
					 $('.qsncontainer').css('min-height','650px');
				 }else{
					 $('.qsncontainer').css('min-height','475px');
				 }
				var qnsnum = data[i]['qnsnum'];
				if(qnsnum==1){ 
				 $("#but_prev").attr("disabled",true);
				}else{
				 $("#but_prev").attr("disabled",false); 
				}
				
                if(i == 0){
                    var allcount =<?php echo $disqsnnum; ?>; 
                }else{
                    var qnsnum = data[i]['qnsnum'];
                    var id = data[i]['id'];
                    var title = data[i]['title'];
                    var ans1 = data[i]['ans1'];
                    var ans2 = data[i]['ans2'];
                    var ans3 = data[i]['ans3'];
                    var ans4 = data[i]['ans4'];
                    var image = data[i]['image']; 
					if(image!=''){
					 var imghtm="<br><div class='qsnimg' style='background-image: url(<?php echo URL; ?>admin/gallery/"+image+");'></div>";
					}else{
					var imghtm=''; 	
					}
					if(ans3!=''){
						var asn3html="<td class=qsn><div class='funkyradio-success'><input type=radio id='3' name=ans value=3><label for='3'><div>"+ans3+"</div></label></div></td>";
					}else{
						var asn3html="";
					}					
					if(ans4!=''){
						var asn4html="<td class=qsn><div class='funkyradio-success'><input type=radio id='4' name=ans value=4><label for='4'><div>"+ans4+"</div></label></div></td>";
					}else{ 
						var asn4html="";
					}
                    var true_ans = data[i]['true_ans']; 
                    $("#emp_table").append("<tr id='tr_"+i+"'></tr>");
                    $("#tr_"+i).append("<td  style=display:block;margin-bottom:15px;><input type=hidden name=qsnid value='"+id+"' ><pre><div  class='qsnnum'> "+qnsnum+"."+title+imghtm+"</div></pre></td>");
                    $("#tr_"+i).append("<td class=qsn><div class='funkyradio-success'><input type=radio id='1' name=ans value=1><label for='1'><div>"+ans1+"</div></label></div></td>");
                    $("#tr_"+i).append("<td class=qsn><div class='funkyradio-success'><input type=radio id='2' name=ans value=2><label for='2'><div>"+ans2+"</div></label></div></td>");
                    $("#tr_"+i).append(asn3html);
                    $("#tr_"+i).append(asn4html);
                }
            }
        } 
	function end(){
	data = prompt("Are you sure to end this Quiz? Remember, once finished, you wont be able to continue anymore and final results will be displayed. If you want to continue then enter YES in the textbox below and press enter");
	if(data=="yes"){
	window.location ="<?php echo URL; ?>account.php?msg=1";
	}
	}
    </script>

<script> 
//var time= <?php echo $time; ?>;
var time=<?php echo $totaltime; ?>;
window.setTimeout(function() {
window.location.href ="<?php echo URL; ?>account.php?msg=1;
}, 1000*30*time); 
</script>
<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds+" minutes!";

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * <?php echo $totaltime; ?>,
        display = document.querySelector('#countdown');
    startTimer(fiveMinutes, display);
};
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
            <li class="active"><a href="<?php echo URL; ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo URL."quiz.php";?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Quiz</a></li>
            
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
					<font size="3">Test closes in  </font>
					<span class="timer btn btn-default">
					<font style="" id="countdown"> </font></span>

					<span class="timer btn btn-primary"  onclick="end()">
					<a href="#" style="color:#fff"><span class=" glyphicon glyphicon-off"></span> <font style="font-size:12px;font-weight:bold">Finish Quiz</font></span></a> 
					</div> 
				<form name='qform' method='post' action='quiz.php' id='qform' class="form-horizontal">
				 <div class="funkyradio">
				<table width="100%" id="emp_table" border="0" >
				<tr class="tr_header">

				</tr>
				</table>
				</div> 
				</form>
			     <div class="col-md-12 col-sm-12 quizhead">  
				<input type="hidden" id="tid" value="<?php echo $id; ?>">
				<input type="hidden" id="txt_rowid" value="0"> 
				<input type="hidden" id="txt_allcount" value="<?php echo $disqsnnum-1; ?>"> 				 				
                 <!--<a  class="btn btn-primary" style="height:30px" id="but_prev"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true" style="font-size:12px" ></span></a>	-->	   
				  <a  class="btn btn-primary" style="padding: 15px 50px;" id="but_next"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true" style="font-size: 20px;"></span></a>
				  </div> 
            </div>
			</div>
      </div>
   </div>
   <!-- ./container -->
</div>
<?php include_once "footer.php";  ?>