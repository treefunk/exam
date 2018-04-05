<div class="container">
<div class="row col-md-7 col-md-offset-3">
    time: <div id="timer"></div>
    
    <form id="examform" action="<?=base_url("exams/submit/{$this->session->userdata('id')}/{$exam->id}")?>" method="post">
        <?php foreach($questions as $question): ?>
            <?=$question['question']?> <!-- Question --> <br>
    
            <?php foreach($question['answers'] as $key=>$answer): ?> <!-- Answers -->
                <input type="radio" name="<?=$question['id']?>" value="<?=$key?>"><?=$answer->answer?>
            <?php endforeach;?>
        <br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
</div>




</div>

<script>

</script>
<script>

// src https://stackoverflow.com/questions/20618355/the-simplest-possible-javascript-countdown-timer

function startTimer(duration, display,callback) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        if (timer != 0) {
            if(timer % 10 == 0 && timer != 0){
                var httprequest = new XMLHttpRequest()

                httprequest.onreadystatechange = () => {
                    if(httprequest.readyState == 4){
                        //alert(httprequest.responseText)
                    }
                }

                httprequest.open('GET',`<?=base_url("AjaxController/onLoadAjax/{$exam->id}/{$this->session->userdata('id')}")?>`)
                httprequest.send();
            }
            --timer

        }else{
            callback();
        }

    }, 1000);
}

window.onload = function () {
    //get time here
    httprequest = new XMLHttpRequest();

    httprequest.onreadystatechange = () => {
        if(httprequest.readyState == 4){
            var time = httprequest.responseText,
            display = document.querySelector('#timer');
            if(isNaN(time)){
                return -1;
            }
            startTimer(time, display,() => {
                var form = document.getElementById('examform');
                form.submit();
            });
        }
}
     httprequest.open('POST',`<?=base_url("AjaxController/onLoadAjax/{$exam->id}/{$this->session->userdata('id')}")?>`)
     httprequest.send();


};
setInterval(function(){
    
}, 10000);
</script>
</script>
</script>