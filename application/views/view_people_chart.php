
<?php //var_dump_pretty($relatorio);?>

<?php if ($relatorio):?>
<div class="row">


	<div class="col-xs-12">


	<!-- HTML -->
	<h2>Gráfico</h2>
	<div style="width:80%; height: 300px;" id="flot-bar-chart"></div>


	</div>
	<!-- /.row -->
</div>
<script>
//Flot Bar Chart

$(function() {

    var dataSet = [<?=$relatorio;?>];

    var barOptions = {

        xaxis: {
            mode: "time",
            timeformat: "%Y-%m",
            tickSize: [1, "month"]
        },
        yaxes: [
            //yaxis:1
            {
                position: "left",
                max: <?=$maxY;?>,
                color: "black",
                axisLabel: "Custo Funcionários",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3
            },
            //yaxis:2
            {
                position: "right",
                max: <?=$maxY;?>,
                clolor: "black",
                axisLabel: "Custo Fixo Médio",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3
            }
        ],
        grid: {
            hoverable: true
        },
        legend: {
            show: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "x: %x, y: %y"
        }
    };

    $.plot($("#flot-bar-chart"), dataSet, barOptions);

});

function gd(year, month, day) {
   	return new Date(year, month - 1, day).getTime();
}

</script>
<?php endif;?>