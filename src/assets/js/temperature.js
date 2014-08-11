/**
 * Created by chris on 11/08/14.
 */

Morris.Line({
    element: 'temperatureGraph',
    data: temperatures,
    xkey: 'time',
    ykeys: ['temperature'],
    labels: ['Temperature'],
    pointSize: 0,
    hideHover: 'always'
});