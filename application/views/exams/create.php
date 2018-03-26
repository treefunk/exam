Create Exam for <?=$classroom->name?>
<button id="addquestion">Add Question</button>


<div id="qSummary">

</div>
<div id="questions">

</div>
<div id="answers">

</div> 
<div id="exam">

</div>


<script>

var counter = 0
var question = 
`
<select id="questionType"  name="qType${counter}">
    <option value="truefalse">True or False</option>
    <option value="multiplechoice">Multiple Choice</option>
    <option value="shortanswer">Short Answer</option>
</select>

Question: 

<input type="text" id="customQuestion">

`


var truefalse =
`
<input type="radio" name="" id="true" value="1">True
<input type="radio" name="truefalse" id="false" value="0">False

`

var multiplechoice=
`
<div id="mchoices">
    <input type="text" name="multianswer[]" id="answer">
    <input type="text" name="multianswer[]" id="answer">
</div>
    <button id="addresponse">add response</button>

`


var summary = []




var questionsDiv = document.getElementById('questions')
var addQuestionButton = document.getElementById('addquestion')
var answersDiv = document.getElementById('answers')
var qSummary = document.getElementById('qSummary')

addQuestionButton.addEventListener('click',function(e){
    if(counter != 0){

        var q = document.getElementById('customQuestion').value
        var questiontype = document.getElementById('questionType').value
        
        var inputs = document.getElementsByName('multianswer[]')
        var responses = []

        for (var i = 0; i < inputs.length; i += 1) {
            responses.push(inputs[i].value)
        }

        

        summary.push({
            question: q,
            questionType: questiontype,
            answers:responses
        })
    
    }

    questionsDiv.innerHTML = question;
    var questionType = document.getElementById('questionType');
    switch(questionType.value){
        case "truefalse":
            answersDiv.innerHTML = truefalse;
        break;
        case "multiplechoice":
            answersDiv.innerHTML = multiplechoice;
        break;
    }
    refreshSummary()


    counter++;
        questionType.addEventListener('change',function(){
            switch(questionType.value){
            case "truefalse":
                answersDiv.innerHTML = truefalse;
            break;
            case "multiplechoice":
                answersDiv.innerHTML = multiplechoice;
            break;
            case "shortanswer":
                answersDiv.innerHTML = shortanswer;
            break;
        }
    })
})

function refreshSummary(){
    var qa = ''
    for(var x=0;x < summary.length; x++){
        qa += `
            question ${x+1}:
            ${summary[x].question}----------
            questionType:
            ${summary[x].questionType}
            <br>
        `
        if(summary[x].answers.length > 0){
            qa += `
                choices:<br>
            `
            for(answer of summary[x].answers){
                qa+= `--${answer}--<br>`
            }
        }
    } 

    qSummary.innerHTML = qa
}






//yung summary(variable) ung issend sa php pagtapos na lahat

</script>