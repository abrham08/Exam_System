<?php 

include "header.php";
// if (isset($_SESSION['huid']) && isset($_SESSION['hdepid'])) {
  //echo 'n'.$_SESSION['uiid']; 
  //echo 'na'. $_SESSION['fname']; 
    include "dbc.php";
    $uid = $_SESSION['huid'];
    $depart = $_SESSION['hdepid'];
  
  
    $fetch = $pdo->prepare('SELECT ex_group, COUNT(*) AS count FROM examinee WHERE Department = :depa  GROUP BY ex_group');
    $fetch->bindValue(':depa', $depart);
    $fetch->execute();
    $cat = $fetch->fetchAll(PDO::FETCH_ASSOC);
    
    $categoryCounts = array();
    $cname=array();
    foreach ($cat as $row) {
        $category = $row['ex_group'];
        array_push($cname, $category);
        $count = $row['count'];
        $categoryCounts[$category] = $count;
    }

    

    ?>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/piechart.css" rel="stylesheet" type="text/css">

        <title>Menu</title>
        <style>
        .minu:hover{transition:0.81s;transform:scale(1.3);}

        .text-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

.welcome-text {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeAndSlide 1.5s forwards;
}

@keyframes fadeAndSlide {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}


    
    canvas {
            max-height: 300px;
        }
    
    </style>

    <title>Head</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<div class="text-center">
  <h3 class="welcome-text">Welcome to DKU Online Examination System</h3>
</div>

  <div class="row">
 <div class="col">
  <span>Number of Students</span>
 <canvas id="chart1"></canvas></div>
 <div class="col"><canvas id="chart2"></canvas></div>
  </div>
    <script>
        window.onload = function() {
            // Simulating PHP data
            var numdata1 = [];
            var data1 = [];
            <?php foreach ($categoryCounts as $ssvalue) { ?>
              numdata1.push('<?php echo $ssvalue; ?>');
            <?php } ?>

            <?php foreach ($cname as $svalue) { ?>
              data1.push('<?php echo $svalue; ?>');
            <?php } ?>

            console.log(numdata1); 


            var data2 = [10, 20, 30];

            createPieChart('chart1', data1, numdata1, ['#ff6384', '#36a2eb', '#ffce56']);
            createPieChart('chart2', ['Section A', 'Section B', 'Section C'], data2, ['#ff6384', '#36a2eb', '#ffce56']);
        };

        function createPieChart(canvasId, labels, data, colors) {
            var ctx = document.getElementById(canvasId).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            fontColor: '#333',
                            fontSize: 12
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }
    </script>














    <script src="js/piechart.js"></script>

      </body>
    </html>
    

<?php 
// }else{
//   header("Location: ../index.php");
//      exit();
// }
 ?>