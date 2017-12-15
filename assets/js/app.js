$('#submit').click(function(){
    //We start by getting the value of the form
    var start = $('#start').val();
    var end = $('#end').val();
    var priceYear = $('#priceYear').val();
    var classPerDay = $('#classPerDay').val();
    var holidayWeeks = $('#holidayWeeks').val();
    //console.log('start : ' + start);
    //console.log('end : ' + end);
    //console.log('priceYear : ' + priceYear);
    //console.log('classPerDay : ' + classPerDay);

    if(priceYear <= 0 || classPerDay <= 0 || holidayWeeks < 0){
        event.preventDefault();
        alertify.error('We can\'t calculate with a negative value or 0, please check the form again');
    }
    else{
        //Now we truncate the dates to calculate the time
        start = start.split("-");

        var yearStart = start[0];
        var monthStart = start[1];
        var dayStart = start[2];

        //console.log('start :', start);
        //console.log('yearStart', yearStart);
        //console.log('monthStart', monthStart);
        //console.log('dayStart', dayStart);

        end = end.split("-");

        var yearEnd = end[0];
        var monthEnd = end[1];
        var dayEnd = end[2];
        //console.log(yearEnd);
        //console.log(monthEnd);
        //console.log(dayEnd);

        //Now we calculate the time
        var year = yearEnd - yearStart;
        var month = monthEnd - monthStart;
        var day = dayEnd - dayStart;
        //console.log(year);
        //console.log(month);
        //console.log(day);

        totalDays = year*365 + month*30 + day;

        if(totalDays <= 0){
            event.preventDefault();
            alertify.error('The date you set is impossible, please check the form');
        }
        else{
            //Here we subtract the number of days of the holidays
            totalDays = totalDays- (holidayWeeks * 7);

            //Here we subtract the number of days of the week-end
            var weekEnd = (totalDays/7)*2;
            //console.log('week-end : ' + weekEnd);
            totalDays = totalDays - weekEnd;
            //console.log('number of day : ' + totalDays);

            priceDay = priceYear / totalDays;
            priceDay = Math.floor(priceDay);

            priceClass = priceDay/ classPerDay;
            priceClass = Math.floor(priceClass);

            //console.log('Price/day : ' + priceDay);
            //console.log('Price/class : ' + priceClass);

            alertify.alert('You are spending ' + priceDay + '€ each day in your school, and ' + priceClass + '€ each class ... So you definitely don\'t want to skip class ;) ');
        }
    }
});