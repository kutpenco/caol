
<?php //var_dump_pretty($relatorio);?>

<?php if ($relatorio):?>
<div class="row">


	<div class="col-xs-12">


	<!-- HTML -->
	<h2>Gráfico</h2>
	<div style="width: 100%; height: 500px;" id="flot-pie-chart"></div>


	</div>
	<!-- /.row -->
</div>
<script>
//Flot Pie Chart

$(function() {

    /*
    var dataSet = [
        {label: "Asia", data: 4119630000, color: "#005CDE" },
        { label: "Latin America", data: 590950000, color: "#00A36A" },
        { label: "Africa", data: 1012960000, color: "#7D0096" },
        { label: "Oceania", data: 35100000, color: "#992B00" },
        { label: "Europe", data: 727080000, color: "#DE000F" },
        { label: "North America", data: 344120000, color: "#ED7B00" }
    ];
    */

    var dataSet = [<?=$relatorio;?>];

    var options = {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: function (label, series) {
                        if(Math.round(series.percent) > 0)
                            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
                        else
                            return "";
                    },
                    background: {
                        opacity: 0.5,
                        color: "#000"
                    }
                }
            }
        },
        legend: {
            show: true
        },
        grid: {
            hoverable: true
        }
    };

    $.plot($("#flot-pie-chart"), dataSet, options);

});

function gd(year, month, day) {
   	return new Date(year, month - 1, day).getTime();
}

</script>

<?php endif;?>