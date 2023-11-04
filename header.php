<?php include "connect.php";?>
<html>
<head>
    <title>WHISK & ROLL BAKERY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home2.css" rel="stylesheet">
    <script>
        function Search(){
            let searchvalue = document.getElementById('search').value;

            let formData = new FormData();
            formData.append('search',searchvalue);

            let url = 'menu.php'
            request = new XMLHttpRequest();
            request.onreadystatechange = showResult;
            request.open('POST',url);
            request.send(formData)
        }

        function showResult(){
            if(request.readyState == 4 && request.status == 200){
                document.getElementById('notification').innerHTML = request.responseText;
                window.location.href = 'menu.php';
            }
        }

        window.onload = function(){
            let search  = document.getElementById('search');
            search.onblur = Search;
        }
    </script>

</head>
    <body>
   
    </body>

    </html>