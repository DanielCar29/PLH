<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grafica</title>
    <script src="/node_modules/chart.js/dist/chart.js"></script>
</head>
<body>
    <div>
        <canvas id="grafica" height="400" width="400"></canvas>
    </div>
    
</body>
<script>
    let miCanvas = document.getElementById("grafica").getContext("2d");

    var chart = new Chart(miCanvas, {
        type:"bar",
        data:{
            labels:["Enero","Febrero","Marzo","Abril"],
            datasets:[
                {
                    label:"GRAFICA",
                    backgroundColor:"rgb(0,0,0)",
                    data:[12,30,5,10]
                }
            ]
        }

    })
</script>
</html>