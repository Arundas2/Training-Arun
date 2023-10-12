$(document).ready(function(){
    var pbar=$('#progressbar');
    var c=["red","yellow","green"];
    var count=0;
    var interval;

    function changecolor(){
        if(count==3) {
            var colour="white";
            pbar.css('background',colour);
            return;
        } else {
            pbar.css('background',c[count]);
            count=(count+1);
        }
        
    }
    $('#pbtn').click(function(){
        clearInterval(interval);
        pbar.css('width','100%');
    
        $.ajax({
            type:'GET',
            url:'progressbar.php',
            success:function(response){
                interval=setInterval(changecolor,2000);
            },
            error:function(){
                clearInterval(interval);
            }
        })
    })
})

