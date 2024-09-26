<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=0,user-scalable=no">
    <title>blogging system</title>
    <!-- bootstrap cdn  -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
     
    />
    <!-- custom css  -->
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- aos  -->
    <link rel="stylesheet" href="assets/aos/aos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       let sweetAlert = (message,page)=>{
        Swal.fire({
              icon: "success",
              title: "Congraz...",
              text: "You have successfuly " + message ,
              confirmButtonText: 'OK'
    
            })
            .then(()=>
            {location.href=page}
            )
        }
      </script>
  
</head>
<body>


