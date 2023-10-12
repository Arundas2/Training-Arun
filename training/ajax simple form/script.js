$(document).ready(function(){
    $("#myform").submit(function(event){
        event.preventDefault();
        var formdata=$(this).serialize();

        $.ajax({
            type:'POST',
            url:'main.php',
            data:formdata,
            success:function(response){
                $("#message").html(response);
                $("#myform")[0].reset();
            }

        })
    })
})