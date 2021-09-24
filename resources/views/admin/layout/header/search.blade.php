<style>
    .clock {
        position: absolute;
        top: 50%;
        left: 12%;
        transform: translateX(-50%) translateY(-50%);
        color: #0f0f0f;
        font-size: 28px;
        letter-spacing: 3px;
    }
</style>
<div class="header-left">
    <div class="icon" style="margin-left: 35px; padding-right: 4px;
        padding-left: 4px;">
        <i class="icon-copy dw dw-wall-clock1" id="icon_lock"
            style="vertical-align: middle;font-size: 30px; color: #0f0f0f">
        </i>
    </div>
    <div id="MyClockDisplay" class="clock" onload="showTime()"
        style="padding-left: 90px;">
    </div>
</div>
<script>
    function showTime(){
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if(h == 0){
            h = 12;
        }

        if(h > 12){
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }
    showTime();
</script>
