


<?php if ($relatorio):?>
<div class="row">


	<div class="col-xs-12">


	<!-- HTML -->
	<h2>Gráfico</h2>
	<div style="width:80%; height: 400px;" id="flot-bar-chart"></div>


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
        }
    };

    $.plot($("#flot-bar-chart"), dataSet, barOptions);

    $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #a9a9a9",
            padding: "2px",
            "background-color": "#ffbebe",
            opacity: 0.80
        }).appendTo("body");

    $("#flot-bar-chart").bind("plothover", function (event, pos, item) {

        if (item) {

            var y = item.datapoint[1].toFixed(2);

            var myDate = new Date( item.datapoint[0] );
            var month = myDate.getMonth();

            if(month < 10)
                month = "0" + month.toString();

            var x = myDate.getFullYear().toString() + '-' + month;

            $("#tooltip").html("<strong>" + item.series.label + '</strong><br> ' + x + ' = <span class="currency">' + y + '</span>')
                .css({top: item.pageY+5, left: item.pageX+5})
                .fadeIn(200);

            $('.currency').autoNumeric();

            $('.currency').autoNumeric('update', {
                aSep: '.',
                wEmpty: '',
                aSign: "R$ ",
                aDec: ',',
                mDec: 2,
                vMin : -9999999
            });



        } else {
            $("#tooltip").hide();
        }

    });

});

function gd(year, month, day) {
   	return new Date(year, month - 1, day).getTime();
}

</script>

<?php endif;?>