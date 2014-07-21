var weathers = {
  'NA' : { 'desc': 'Not available', 'sym' : 'G' },
  '0'  : { 'desc': 'Clear night', 'sym' : 'C' },
  '1'  : { 'desc': 'Sunny day', 'sym' : 'B' },
  '2'  : { 'desc': 'Partly cloudy', 'sym' : 'I' }, //(night)
  '3'  : { 'desc': 'Partly cloudy', 'sym' : 'H' }, //(day)
  '4'  : { 'desc': 'Not used', 'sym' : 'G' },
  '5'  : { 'desc': 'Mist', 'sym' : 'E' },
  '6'  : { 'desc': 'Fog', 'sym' : 'M' },
  '7'  : { 'desc': 'Cloudy', 'sym' : 'N' },
  '8'  : { 'desc': 'Overcast', 'sym' : 'L' },
  '9'  : { 'desc': 'Light rain shower', 'sym' : 'Q' },//(night)
  '10' : { 'desc': 'Light rain shower', 'sym' : 'Q' },//(day)
  '11' : { 'desc': 'Drizzle', 'sym' : 'Q' },
  '12' : { 'desc': 'Light rain', 'sym' : 'Q' },
  '13' : { 'desc': 'Heavy rain shower', 'sym' : 'R' },//(night)
  '14' : { 'desc': 'Heavy rain shower', 'sym' : 'R' },//(day)
  '15' : { 'desc': 'Heavy rain', 'sym' : 'R' },
  '16' : { 'desc': 'Sleet shower', 'sym' : 'U' },//(night)
  '17' : { 'desc': 'Sleet shower', 'sym' : 'U' },//(day)
  '18' : { 'desc': 'Sleet', 'sym' : 'U' },
  '19' : { 'desc': 'Hail shower', 'sym' : 'X' },//(night)
  '20' : { 'desc': 'Hail shower', 'sym' : 'X' },//(day)
  '21' : { 'desc': 'Hail', 'sym' : 'X' },
  '22' : { 'desc': 'Light snow shower', 'sym' : 'U' },//(night)
  '23' : { 'desc': 'Light snow shower', 'sym' : 'U' },//(day)
  '24' : { 'desc': 'Light snow', 'sym' : 'U' },
  '25' : { 'desc': 'Heavy snow shower', 'sym' : 'W' },//(night)
  '26' : { 'desc': 'Heavy snow shower', 'sym' : 'W' },//(day)
  '27' : { 'desc': 'Heavy snow', 'sym' : 'W' },
  '28' : { 'desc': 'Thunder shower', 'sym' : 'P' },//(night)
  '29' : { 'desc': 'Thunder shower', 'sym' : 'P' },//(day)
  '30' : { 'desc': 'Thunder', 'sym' : 'P' },
};

var weekday=new Array(7);
weekday[0]="Sunday";
weekday[1]="Monday";
weekday[2]="Tuesday";
weekday[3]="Wednesday";
weekday[4]="Thursday";
weekday[5]="Friday";
weekday[6]="Saturday";

$(function() {
  var width = $('#weatherTable').parents('div.hero-unit').width();
  var max = 5;
  var cellWidth = 20;
  if (width < 300) {
    max = 3;
    cellWidth = 100/3;
  }
  console.log(width);
  var count = 0;
  $.get('/display/index.php/weather', function(d) {
    $.each(d.SiteRep.DV.Location.Period, function(i ,e) {
      count ++;
      var date = new Date(e.value.replace('Z','')),
      weather = weathers[e.Rep[0].W];
      $('#dateRow').append('<th style="width:' + cellWidth + '%">' + weekday[date.getDay()] + '</th>');
      $('#iconsRow').append('<td class="weather-icon">' + weather.sym + '</td>');
      $('#weatherRow').append('<td>' + weather.desc + '</td>');
      
      return (count < max);
    });
    
    if (max === 3) {
      $('#weatherTable').parents('div.hero-unit').children('h3').text('3 Day Weather Forecast');
    }
  }, 'json');
});
