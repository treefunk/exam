Create Exam for <?=$classroom->name?>



<div id="qSummary">

</div>
<div id="questions">

</div>
<div id="answers">

</div> 

<div id="exam">

</div>
<button id="addresponse" style="display:none">Add Answer</button>
<button id="removelastresponse" onclick="removeLast()" style="display:none">Remove Last Question</button>
<button id="addquestion">Add Question</button>


<script>

var counter = 0
var question = 
`
<select id="questionType"  name="qType${counter}">
    <option value="truefalse">True or False</option>
    <option value="multiplechoice">Multiple Choice</option>
</select>

Question: 

<input type="text" id="customQuestion">

`


var truefalse =
`
A: <input type="radio" name="truefalse" id="truefalse" value="0" checked>True
<BR>
B: <input type="radio" name="truefalse" id="truefalse" value="1">False

`

var multiplechoice=
`
<div id="mchoices">
   <div>A: <input type="radio" name="mchoicesanswer" id="multicorrectanswer0" value="0" checked><input type="text" name="multianswer[]" id="manswer1"></div> 
   <div>B: <input type="radio" name="mchoicesanswer" id="multicorrectanswer1" value="1"><input type="text" name="multianswer[]" id="manswer2"></div>
</div>

`
    
var summary = []




var questionsDiv = document.getElementById('questions')
var addQuestionButton = document.getElementById('addquestion')
var answersDiv = document.getElementById('answers')
var qSummary = document.getElementById('qSummary')
var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"


var ctr = 2;

addQuestionButton.addEventListener('click',function(e){

    if(counter != 0){
        if(document.getElementById('customQuestion').value.trim() == ""){
            alert(`You can't leave the question field blank!`)
            return -1;
        }
        currentresponse = 1

        ctr=2;
        var q = document.getElementById('customQuestion').value
        var questiontype = document.getElementById('questionType').value
        
        var inputs = document.querySelectorAll("[id*='manswer']");
        var leftBlank = 0;

        for(x = 0; x < inputs.length; x++){
            if(inputs[x].value.trim() == ""){leftBlank++}
        }

        if(leftBlank > 0){
            alert('You left a field blank! please check carefully');
            return -1
        }

        var correctanswer
        if(questiontype == 'truefalse'){
            correctanswer = document.querySelector('input[name="truefalse"]:checked').value;
        }else{
            correctanswer = document.querySelector('input[name="mchoicesanswer"]:checked').value;
        }

        var responses = []

        for (var i = 0; i < inputs.length; i += 1) {
            responses.push(inputs[i].value)
        }
        
        if(responses === [] || responses.length == 0){
            responses[0] = 'True'
            responses[1] = 'False'
        }

        summary.push({
            question: q,
            questionType: questiontype,
            answers:responses,
            correctanswer: correctanswer
        })
    
    }

    questionsDiv.innerHTML = question;
    var questionType = document.getElementById('questionType');
    switch(questionType.value){
        case "truefalse":
            answersDiv.innerHTML = truefalse;
            
            document.getElementById('addresponse').style.display = "none";
            document.getElementById('removelastresponse').style.display = "none";
            
        break;
        case "multiplechoice":
            answersDiv.innerHTML = multiplechoice;
            document.getElementById('addresponse').style.display = "block";

            var mchoices = document.getElementById('mchoices')
        break;
    }
    refreshSummary()


    counter++;
        questionType.addEventListener('change',function(){
            switch(questionType.value){
            case "truefalse":
                answersDiv.innerHTML = truefalse;
                document.getElementById('addresponse').style.display = "none";
                document.getElementById('removelastresponse').style.display = "none";
            break;
            case "multiplechoice":
                answersDiv.innerHTML = multiplechoice;
                document.getElementById('addresponse').style.display = "block";
                var mchoices = document.getElementById('mchoices')
            break;

        }
    })
})

function refreshSummary(){
    var qa = ''
    for(var x=0;x < summary.length; x++){
        qa += `
            <button onClick="del(${x})">x</button>
            question ${x+1}:
            <textarea disabled>
            ${summary[x].question}
            </textarea>
            <br>
            questionType:
            ${summary[x].questionType}
            <br>
        `
        if(summary[x].answers.length > 0){
            qa += `
                choices:<br>
            `
            for(y = 0; y < summary[x].answers.length; y++){
                qa+= `${alphabet[y]}: [${summary[x].answers[y]}]<br>`
            }
        }

        qa += `Correct Answer: ${alphabet[summary[x].correctanswer]} / ${summary[x].answers[summary[x].correctanswer]} <br>`
    } 

    qSummary.innerHTML = qa
}

function del(index)
{
    summary.splice(index,1);
    refreshSummary();
}

function removeLast(index)
{
    if(currentresponse != 1){
        var mch = document.querySelectorAll("div[id='mchoices']>div");
        if(mch[mch.length-1].childNodes[1].checked == true){
            mch[0].childNodes[1].checked = true
        }
        mch[mch.length-1].remove();
        currentresponse--
        ctr--
    }
    if(currentresponse == 1){
        document.getElementById('removelastresponse').style.display = "none";
    }
    //document.querySelector("div[id='mchoices']>div").remove();
}


var maxaddresponse = 25;
var currentresponse = 1;
document.getElementById('addresponse').addEventListener('click', () => {
    if(currentresponse != maxaddresponse){
        mchoices.insertAdjacentHTML('beforeend',
        `
        <div>
        ${alphabet[++currentresponse]}: 
        <input type="radio" name="mchoicesanswer" id="multicorrectanswer${ctr++}" value="${(ctr)-1}">
        <input type="text" name="multianswer[]" id="manswer${ctr}">
        </div>
        `
        )
        if(currentresponse > 1){
            document.getElementById('removelastresponse').style.display = "block";
        }
    }
    
})



</script>