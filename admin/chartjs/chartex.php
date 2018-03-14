<html>
    <head><title>Example</title></head>
    <body>
    
        <script src="Chart.bundle.min.js"></script>
        
        
        <canvas id="myChart" width="50"></canvas>
        <script>
          
             var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                    labels: ["M", "T", "W", "T", "F", "S", "S"],
                    datasets: [{
                      label: 'apples',
                      data: [<?php print $var=199?>, 19, 3, 17, 28, 24, 100],
                      backgroundColor: "rgba(153,255,51,1)"
                    }, 
                    {
                      label: 'oranges',
                      data: [30, 29, 5, 5, 20, 3, 10],
                      backgroundColor: "rgba(255,153,0,1)"
                    }]
                  }
                });
        </script>
        
    </body>
</html>