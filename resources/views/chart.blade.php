<!DOCTYPE html>
<html>
<head>
    <title>Average Data (Example)</title>
</head>

<body>
<h1>Average Data (Example)</h1>
<canvas id="myChart" height="60px"></canvas>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">

    var labels =  {{ Js::from($labels) }};
    var openVal =  {{ Js::from($openValues) }};
    var closeVal = {{ Js::from($closeValues) }};
    var highVal = {{ Js::from($highValues) }};
    var lowVal = {{ Js::from($lowValues) }};

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'open',
                data: openVal,
                fill: false,
                borderColor: ['rgba(75, 192, 192)'],
                tension: 0.1
            },
            {
                label: 'close',
                data: closeVal,
                fill: false,
                borderColor: ['rgba(158,236,67)'],
                tension: 0.1
            },
            {
                label: 'high',
                data: highVal,
                fill: false,
                borderColor: ['rgba(241,16,107)'],
                tension: 0.1
            },
            {
                label: 'low',
                data: lowVal,
                fill: false,
                borderColor: ['rgba(191,67,236)'],
                tension: 0.1
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            padding: 30,
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

</html>
