// Chart of Most P2P Transaction
am4core.useTheme(am4themes_animated);
var pie_cd = am4core.create("pie_most_trx_cd", am4charts.PieChart);


pie_cd.data = dt_most_trx_cd;


var series = pie_cd.series.push(new am4charts.PieSeries());
series.dataFields.value = "tot_trx";
// series.dataFields.radiusValue = "tot_trx";
series.dataFields.category = "p2p_name";

series.ticks.template.disabled = true;
series.alignLabels = false;
series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
series.labels.template.radius = am4core.percent(-40);
series.labels.template.fill = am4core.color("white");

// this makes initial animation
series.hiddenState.properties.opacity = 1;
series.hiddenState.properties.endAngle = -90;
series.hiddenState.properties.startAngle = -90;

pie_cd.legend = new am4charts.Legend();

// PIE Credit
var pie_c = am4core.create("pie_most_trx_c", am4charts.PieChart);


pie_c.data = dt_most_trx_c;


var series = pie_c.series.push(new am4charts.PieSeries());
series.dataFields.value = "tot_trx";
// series.dataFields.radiusValue = "tot_trx";
series.dataFields.category = "p2p_name";

series.ticks.template.disabled = true;
series.alignLabels = false;
series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
series.labels.template.radius = am4core.percent(-40);
series.labels.template.fill = am4core.color("white");

// this makes initial animation
series.hiddenState.properties.opacity = 1;
series.hiddenState.properties.endAngle = -90;
series.hiddenState.properties.startAngle = -90;

pie_c.legend = new am4charts.Legend();

// PIE Debit
var pie_d = am4core.create("pie_most_trx_d", am4charts.PieChart);


pie_d.data = dt_most_trx_d;


var series = pie_d.series.push(new am4charts.PieSeries());
series.dataFields.value = "tot_trx";
// series.dataFields.radiusValue = "tot_trx";
series.dataFields.category = "p2p_name";

series.ticks.template.disabled = true;
series.alignLabels = false;
series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
series.labels.template.radius = am4core.percent(-40);
series.labels.template.fill = am4core.color("white");

// this makes initial animation
series.hiddenState.properties.opacity = 1;
series.hiddenState.properties.endAngle = -90;
series.hiddenState.properties.startAngle = -90;

pie_d.legend = new am4charts.Legend();

// Chart of transaction last 12 month
var chart2 = am4core.create("trx_last_12m", am4charts.XYChart);


chart2.data = dt_last_12m;

chart2.padding(30, 30, 10, 30);
chart2.legend = new am4charts.Legend();

chart2.colors.step = 2;
chart2.numberFormatter.numberFormat = "#,###";

var categoryAxis = chart2.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.minGridDistance = 60;
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.interactionsEnabled = false;

var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.renderer.grid.template.strokeOpacity = 0.05;
valueAxis.renderer.minGridDistance = 20;
valueAxis.interactionsEnabled = false;
valueAxis.min = 0;
valueAxis.renderer.minWidth = 35;

var series1 = chart2.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText = "{name}: IDR {valueY.value}";
series1.name = "Credit";
series1.dataFields.categoryX = "category";
series1.dataFields.valueY = "credit";
series1.stacked = true;

var series2 = chart2.series.push(new am4charts.ColumnSeries());
series2.columns.template.width = am4core.percent(80);
series2.columns.template.tooltipText = "{name}: IDR {valueY.value}";
series2.name = "Debit";
series2.dataFields.categoryX = "category";
series2.dataFields.valueY = "debit";
series2.stacked = true;

// chart2.scrollbarX = new am4core.Scrollbar();

// Chart of registration (p2p & lender) last 12 month
var chart3 = am4core.create("reg_last_12m", am4charts.XYChart);

// Increase contrast by taking evey second color
chart3.colors.step = 2;

// Add data
chart3.data = generateChartData();

// Create axes
var dateAxis = chart3.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 50;

// Create series
function createAxisAndSeries(field, name, opposite, bullet) {
  var valueAxis = chart3.yAxes.push(new am4charts.ValueAxis());
  
  var series = chart3.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "date";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
  series.name = name;
  series.tooltipText = "{name}: [bold]{valueY}[/]";
  series.tensionX = 0.8;
  
  var interfaceColors = new am4core.InterfaceColorSet();
  
  switch(bullet) {
    case "triangle":
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 12;
      bullet.height = 12;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
      
      var triangle = bullet.createChild(am4core.Triangle);
      triangle.stroke = interfaceColors.getFor("background");
      triangle.strokeWidth = 2;
      triangle.direction = "top";
      triangle.width = 12;
      triangle.height = 12;
      break;
    default:
      var bullet = series.bullets.push(new am4charts.CircleBullet());
      bullet.circle.stroke = interfaceColors.getFor("background");
      bullet.circle.strokeWidth = 2;
      break;
  }
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.strokeWidth = 2;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.opposite = opposite;
  valueAxis.renderer.grid.template.disabled = true;
}

createAxisAndSeries("p2p", "P2P", false, "circle");
createAxisAndSeries("lender", "Lender", true, "triangle");

// Add legend
chart3.legend = new am4charts.Legend();

// Add cursor
chart3.cursor = new am4charts.XYCursor();

// generate some random data, quite different range
function generateChartData() {
  var chartData = [];
  var firstDate = new Date();
  firstDate.setDate(firstDate.getDate() + 30);
  firstDate.setFullYear(firstDate.getFullYear() - 1);
  firstDate.setHours(0, 0, 0, 0);

  // var p2p = 1600;
  // var hits = 2900;
  // var lender = 8700;

  // var category = 0;
  // var p2p = 0;
  // var lender = 0;

  dt = dt_reg_last_12m;
  // var m = 30;
  for (var i = 0; i < dt.length; i++) {
    // we create date objects here. In your data, you can have date strings
    // and then set format of your dates using chart.dataDateFormat property,
    // however when possible, use date objects, as this will speed up chart rendering.
    var newDate = new Date(firstDate);
    // newDate.setDate(newDate.getDate() + i);
    // newDate.setDate(newDate.getMonth() + m);
  	// m += 30;

    // p2p += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    // lender += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    category = dt[i].category;
    p2p = dt[i].p2p;
    lender = dt[i].lender;
    // console.log(p2p);
    // console.log(lender);
    console.log(newDate);
    console.log(category);
    chartData.push({
      date: category,
      p2p: p2p,
      lender: lender
    });
  }
  return chartData;
}