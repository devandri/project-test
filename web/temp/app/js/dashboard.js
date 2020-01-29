var Dashboard = function() {
    return {
        init: function() {
            ! function() {
                if (jQuery.plot) {
                    if ($("#graph01")) {
                        var i = null;
                        $("#graph01_loading").hide(), $("#graph01_content").show();
                        var l = [
                            ["DEC", 300],
                            ["JAN", 600],
                            ["FEB", 1100],
                            ["MAR", 1200],
                            ["APR", 860],
                            ["MAY", 1200],
                            ["JUN", 1450],
                            ["JUL", 1800],
                            ["AUG", 1200],
                            ["SEP", 600]
                        ];
                        $.plot($("#graph01"), [{
                            data: l,
                            lines: {
                                fill: .2,
                                lineWidth: 0
                            },
                            color: ["#BAD9F5"]
                        }, {
                            data: l,
                            points: {
                                show: !0,
                                fill: !0,
                                radius: 4,
                                fillColor: "#9ACAE6",
                                lineWidth: 2
                            },
                            color: "#9ACAE6",
                            shadowSize: 1
                        }, {
                            data: l,
                            lines: {
                                show: !0,
                                fill: !1,
                                lineWidth: 3
                            },
                            color: "#9ACAE6",
                            shadowSize: 0
                        }], {
                            xaxis: {
                                tickLength: 0,
                                tickDecimals: 0,
                                mode: "categories",
                                min: 0,
                                font: {
                                    lineHeight: 18,
                                    style: "normal",
                                    variant: "small-caps",
                                    color: "#6F7B8A"
                                }
                            },
                            yaxis: {
                                ticks: 5,
                                tickDecimals: 0,
                                tickColor: "#eee",
                                font: {
                                    lineHeight: 14,
                                    style: "normal",
                                    variant: "small-caps",
                                    color: "#6F7B8A"
                                }
                            },
                            grid: {
                                hoverable: !0,
                                clickable: !0,
                                tickColor: "#eee",
                                borderColor: "#eee",
                                borderWidth: 1
                            }
                        });
                        $("#graph01").bind("plothover", function(t, a, l) {
                            if ($("#x").text(a.x.toFixed(2)), $("#y").text(a.y.toFixed(2)), l && i != l.dataIndex) {
                                i = l.dataIndex, $("#tooltip").remove();
                                l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                                e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + "M$")
                            }
                        }), $("#graph01").bind("mouseleave", function() {
                            $("#tooltip").remove()
                        })
                    }
                    if ($("#graph02")) {
                        var i = null;
                        $("#graph02_loading").hide(), $("#graph02_content").show();
                        var l = [
                            ["DEC", 500],
                            ["JAN", 1200],
                            ["FEB", 1300],
                            ["MAR", 1500],
                            ["APR", 560],
                            ["MAY", 1100],
                            ["JUN", 1250],
                            ["JUL", 1900],
                            ["AUG", 1700],
                            ["SEP", 400]
                        ];
                        $.plot($("#graph02"), [{
                            data: l,
                            lines: {
                                fill: .2,
                                lineWidth: 0
                            },
                            color: ["#BAD9F5"]
                        }, {
                            data: l,
                            points: {
                                show: !0,
                                fill: !0,
                                radius: 4,
                                fillColor: "#9ACAE6",
                                lineWidth: 2
                            },
                            color: "#9ACAE6",
                            shadowSize: 1
                        }, {
                            data: l,
                            lines: {
                                show: !0,
                                fill: !1,
                                lineWidth: 3
                            },
                            color: "#9ACAE6",
                            shadowSize: 0
                        }], {
                            xaxis: {
                                tickLength: 0,
                                tickDecimals: 0,
                                mode: "categories",
                                min: 0,
                                font: {
                                    lineHeight: 18,
                                    style: "normal",
                                    variant: "small-caps",
                                    color: "#6F7B8A"
                                }
                            },
                            yaxis: {
                                ticks: 5,
                                tickDecimals: 0,
                                tickColor: "#eee",
                                font: {
                                    lineHeight: 14,
                                    style: "normal",
                                    variant: "small-caps",
                                    color: "#6F7B8A"
                                }
                            },
                            grid: {
                                hoverable: !0,
                                clickable: !0,
                                tickColor: "#eee",
                                borderColor: "#eee",
                                borderWidth: 1
                            }
                        });
                        $("#graph02").bind("plothover", function(t, a, l) {
                            if ($("#x").text(a.x.toFixed(2)), $("#y").text(a.y.toFixed(2)), l && i != l.dataIndex) {
                                i = l.dataIndex, $("#tooltip").remove();
                                l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                                e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + "M$")
                            }
                        }), $("#graph02").bind("mouseleave", function() {
                            $("#tooltip").remove()
                        })
                    }
                    if ($("#graph03")) {
                        $("#graph03_loading").hide(), $("#graph03_content").show();
                        var data1 = [
                            ["DEC", 300],
                            ["JAN", 600],
                            ["FEB", 1100],
                            ["MAR", 1200],
                            ["APR", 860],
                            ["MAY", 1200],
                            ["JUN", 1450],
                            ["JUL", 1800],
                            ["AUG", 1200],
                            ["SEP", 600]
                        ];
                        var data2 = [
                            ["DEC", 500],
                            ["JAN", 1200],
                            ["FEB", 1300],
                            ["MAR", 1500],
                            ["APR", 560],
                            ["MAY", 1100],
                            ["JUN", 1250],
                            ["JUL", 1900],
                            ["AUG", 1700],
                            ["SEP", 400]
                        ];

                        $.plot($("#graph03"), 
                            [{
                                label: "Credit Transactions",
                                data: data1,
                                bars: {
                                    show: true,
                                    barWidth: 0.2,
                                    align: "left",
                                }
                            },
                            {
                                label: "Debit Transactions",
                                data: data2,
                                bars: {
                                    show: true,
                                    barWidth: 0.2,
                                    align: "right",
                                }
                            }],
                            {
                                xaxis: {
                                    mode: "categories",
                                    tickLength: 0
                                },
                                grid: {
                                    hoverable: !0,
                                    clickable: !0,
                                    tickColor: "#eee",
                                    borderColor: "#eee",
                                    borderWidth: 1
                                }
                            }
                        );
                    }
                    if ($("#graph04")) {
                        $("#graph04_loading").hide(), $("#graph04_content").show();
                        var data = [{
                            label: "PT. Pelan Pelan Saja",
                            data: 150
                        }, {
                            label: "PT. Kamu Pasti Bisa",
                            data: 100
                        }, {
                            label: "CV. Tak Ada Manusia",
                            data: 40
                        }, {
                            label: "CV. Tak Ada Manusia",
                            data: 310
                        }, {
                            label: "PT. Yang Terlahir Sempurna",
                            data: 405
                        }];
                        
                        $.plot($("#graph04"), data, { 
                            series: {
                                 pie: {
                                     show: true,
                                     radius: 1,
                                     label: {
                                         show: true,
                                         radius: 2 / 3,
                                         formatter: function (label, series) {
                                             return series.data[0][1] + 'K';
                                         },
                                     }
                                }
                            },        
                            legend: {show: true}
                        });
                    }
                }
            }(),
            function() {
                if (0 != $("#m_dashboard_daterangepicker").length) {
                    var e = $("#m_dashboard_daterangepicker"),
                        a = moment(),
                        t = moment().subtract(1, "year");
                    e.daterangepicker({
                        startDate: t,
                        endDate: a,
                        opens: "left",
                        ranges: {
                            Today: [moment(), moment()],
                            Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                            "Last 7 Days": [moment().subtract(6, "days"), moment()],
                            "Last 30 Days": [moment().subtract(29, "days"), moment()],
                            "This Month": [moment().startOf("month"), moment().endOf("month")],
                            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                        }
                    }, r), r(t, a, "")
                }

                function r(t, a, r) {
                    var o = "",
                        n = "";
                    a - t < 100 || "Today" == r ? (o = "Today:", n = t.format("D MMM YYYY")) : "Yesterday" == r ? (o = "Yesterday:", n = t.format("D MMM YYYY")) : n = t.format("D MMM YYYY") + " - " + a.format("D MMM YYYY"), e.find(".m-subheader__daterange-date").html(n), e.find(".m-subheader__daterange-title").html(o)
                }
            }();
        }
    }
}();
jQuery(document).ready(function() {
    Dashboard.init()
});