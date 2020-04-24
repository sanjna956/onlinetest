// JavaScript Document
$("#show").change(function(){
   if($(this).val()=="1")
   {    
       $("#fullpayment").show();
   }
    else
    {
        $("#fullpayment").hide();
    }
});
$("#show").change(function(){
   if($(this).val()=="2")
   {    
       $("#partpayment").show();
   }
    else
    {
        $("#partpayment").hide();
    }
});

$("#sms").change(function(){
   if($(this).val()=="6")
   {    
       $("#package").show();
   }
    else
    {
        $("#package").hide();
    }
});
$("#sms").change(function(){
   if($(this).val()=="7")
   {    
       $("#individual").show();
   }
    else
    {
        $("#individual").hide();
    }
});
$(function () {
        $("input[name='news_type']").click(function () {
            if ($("#con_check").is(":checked")) {
                $("#content_div").show();
            } else {
                $("#content_div").hide();
            }
        });
    });

$(function () {
        $("input[name='news_type']").click(function () {
            if ($("#pdf_check").is(":checked")) {
                $("#pdf_div").show();
            } else {
                $("#pdf_div").hide();
            }
        });
    });