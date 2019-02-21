let $dOut = $('#date'),
    // $hOut = $('#hours'),
    // $mOut = $('#minutes'),
    // $sOut = $('#seconds'),
    // $ampmOut = $('#ampm');
    $time = $('#time'),
    $datetime = $('#datetime');
let months = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];

let days = [
    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];

function update(){
    let date = new Date();

    let ampm = date.getHours() < 12
        ? 'AM'
        : 'PM';

    let hours = date.getHours() === 0
        ? 12
        : date.getHours() > 12
            ? date.getHours() - 12
            : date.getHours();

    let minutes = date.getMinutes() < 10
        ? '0' + date.getMinutes()
        : date.getMinutes();

    let seconds = date.getSeconds() < 10
        ? '0' + date.getSeconds()
        : date.getSeconds();

    let dayOfWeek = days[date.getDay()];
    let month = months[date.getMonth()];
    let day = date.getDate();
    let year = date.getFullYear();

    let dateString = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;


    $dOut.text(dateString);
    // $hOut.text(hours);
    // $mOut.text(minutes);
    // $sOut.text(seconds);
    // $ampmOut.text(ampm);
    $time.text(hours+':'+minutes+':'+seconds+' '+ampm);
    $datetime.text(dateString+' '+hours+':'+minutes+':'+seconds+' '+ampm);
}

update();
window.setInterval(update, 1000);
