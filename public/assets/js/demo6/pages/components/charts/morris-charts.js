"use strict";
// Class definition
var KTMorrisChartsDemo = function() {

    // Private functions
    console.log(buyPrevision);
    var demo1 = function() {
        // LINE CHART
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'kt_morris_1',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [buyPrevision],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a', 'b'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Vendas', 'Valor'],
            lineColors: ['#6e4ff5', '#f6aa33'],
            yLabelFormat: function (x) {
                // x = x.fixed(2);
                return 'R$ '+ x.toString();
            }
        });
    };

    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

jQuery(document).ready(function() {
    KTMorrisChartsDemo.init();
});