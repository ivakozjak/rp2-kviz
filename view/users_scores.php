<?php require_once __DIR__ . '/_header.php'; ?>
<h2>Tvoji ostvareni rezultati</h2>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<canvas id="myChart" style="width:100%;max-width:700px"></canvas>
<script>
    var xyValues = [];
    <?php
    $i = 1;
    foreach ($allscores as $score) {
        if ($score != NULL) { //spremi rezultate riješenih kvizova za korisnika
            //echo "console.log($i);";
            echo "xyValues.push({x:$i, y:$score});";
            $i++;
        } else $i++;
    }
    ?>

    new Chart("myChart", {
        type: "scatter",
        data: {
            datasets: [{
                label: "Rezultati kvizova",
                pointRadius: 4,
                pointBackgroundColor: "rgb(205,92,92)",
                data: xyValues
            }]
        },
        options: {
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                    ticks: {
                        min: 1,
                        max: 15
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Redni broj kviza'
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 15
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Bodovi'
                    }
                }],
            }
        }
    });

    console.log(xyValues);
</script>

<?php require_once __DIR__ . '/_footer.php'; ?>