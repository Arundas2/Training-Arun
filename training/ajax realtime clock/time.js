function updatetime(){
    $.ajax({
        url:'time.php',
        dataType:'json',
        success:function(data){
            $('#currenttime').text('Current Time'+data.time);
        },
        error:function(){
            $('#currenttime').text('error');
        }
    })
}
$(document).ready(function(){
    updatetime();
    setInterval(updatetime,1000);
})