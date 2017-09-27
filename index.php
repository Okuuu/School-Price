<!-- Left to do:
    - Check the form before treat it
    - Allow to change the device
    - Cut the date with a - rather than with hardcoding
    -->

<!DOCTYPE html>
<html>
    <head>
        <title>Page d'index</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">

        <!-- include the script -->
        <script src="alertify/alertify.min.js"></script>
        <!-- include the style -->
        <link rel="stylesheet" href="alertify/css/alertify.min.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="alertify/css/themes/default.min.css" />

    </head>
    <body>
    <h1>Should I skip class ?</h1>
    <div id="form-main">
        <div id="form-div">
            <div class="form" id="form1">

                <p class="name">
                    <input name="name" type="date" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Start Date" id="start" />
                </p>

                <p class="name">
                    <input name="name" type="date" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="End Date" id="end" />
                </p>

                <p class="name">
                    <input name="name" type="number" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Price Per Year" id="priceYear" />
                </p>

                <p class="name">
                    <input name="name" type="number" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Class Per Day (Average)" id="classPerDay" />
                </p>

                <div class="submit" id="submit">
                    <input type="submit" value="SEND" id="button-blue"/>
                    <div class="ease"></div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $('#submit').click(function(){
        //We start by getting the value of the form
        var start = $('#start').val();
        var end = $('#end').val();
        var priceYear = $('#priceYear').val();
        var classPerDay = $('#classPerDay').val();
        //console.log('start : ' + start);
        //console.log('end : ' + end);
        //console.log('priceYear : ' + priceYear);
        //console.log('classPerDay : ' + classPerDay);

        //Now we truncate the dates to calculate the time
        var yearStart = start.substring(0,4);
        var monthStart = start.substring(5,7);
        var dayStart = start.substring(8,10);
        //console.log(yearStart);
        //console.log(monthStart);
        //console.log(dayStart);

        var yearEnd = end.substring(0,4);
        var monthEnd = end.substring(5,7);
        var dayEnd = end.substring(8,10);
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
    })
</script>