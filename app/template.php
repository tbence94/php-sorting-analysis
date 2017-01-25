<!DOCTYPE html>
<html>
<head>
    <title>php-sorting-analysis report</title>
    <style type="text/css">
        #chart{
            display: block;
            width: 100%;
            min-height: 500px;
            height: 100%;
            height: 90vh;
        }
    </style>
</head>
<body>

    <div id="chart"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {packages: ['line']});
        google.charts.setOnLoadCallback(render);

        function render() {
            var chart = document.getElementById('chart');
            var data  = new google.visualization.arrayToDataTable(<?= $results ?>);

            new google.charts.Line(chart).draw(data, {});
        }

        window.addEventListener('resize', function(){ render(); });

    </script>

</body>
</html>