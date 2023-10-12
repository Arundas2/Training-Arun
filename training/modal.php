<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
        <title>modal</title>
        <style>
            .button {
                padding: 10px 40px;
                /*cursor:pointer;*/
                font-size:10px;
                background-color:green;
            }
            .active,.button:hover{
                background-color:grey;
                color:white;
            }
        </style>
        <script>
            $(document).ready(function(){
                $("#price").click(function(){
                    $("#img").attr("src","forest.jpg");
                    $(this).addClass("active");
                    $('#product').removeClass("active");
                    $('#modal').html("Price");
                    $('#content').html("Price");
                });
                $("#product").click(function(){
                    $("#img").attr("src","forest2.jpeg");
                    $(this).addClass("active");
                    $('#price').removeClass("active");
                    $('#modal').html("Product");
                    $('#content').html("Product");
                });
            });
        </script>
    </head>
    <body>
        <div id="ex1" class="modal">
            <h1 id="modal">Price</h1>
            <div id="imagecontainer">
                <img id="img" src="forest.jpg" width=450 height=400 alt="">
            </div>
            <div id="buttons">
                <input type="button" id="price" class="button active" value="Price ">
                <input type="button" id="product" class="button" value="Product ">
            </div>
            <textarea name="content" id="content" cols="50" rows="10">
                Price details.
            </textarea>
            <a href="#" rel="modal:close">Close</a>
        </div>
        <h1>Modal</h1>
        <p><a href="#ex1" rel="modal:open"><button>Open modal</button></a></p>
    </body>
</html>