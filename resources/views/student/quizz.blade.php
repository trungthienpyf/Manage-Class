@extends('layout.masterTeacher')
<!-- start page title -->

@section('breadcrum')
    {{ Breadcrumbs::render('classTeacher') }}
@endsection
<!-- end page title -->


<!-- end row -->

@section('content')

    <div class="card">
        <div class="card-body" style="height: 800px">
            <div class="start-screen">
                <button id="start-button">Bắt đầu</button>
            </div>
            <div id="display-container">
                <div class="header">
                    <div class="number-of-count">
                        <span class="number-of-question">1 of 3 questions</span>
                    </div>

                </div>
                <div id="container">
                    <!-- questions and options will be displayed here -->
                </div>
                <button id="check-button">Kiểm tra</button>
                <button id="next-button" class="hide">Next</button>
            </div>
            <div class="score-container hide">
                <div id="user-score">Demo Score</div>
                <button id="restart">Làm lại</button>

                <a  class="mt-5" href="{{route('quizz.index',$id)}}"> <button class=" p-1" type="button">Về trang trước</button> </a>
            </div>
        </div>

    </div>

@endsection
@push('js')
    <script async type="application/javascript">
        let timeLeft = document.querySelector(".time-left");
        let quizContainer = document.getElementById("container");
        let nextBtn = document.getElementById("next-button");
        let checkBtn = document.getElementById("check-button");
        let countOfQuestion = document.querySelector(".number-of-question");
        let displayContainer = document.getElementById("display-container");
        let scoreContainer = document.querySelector(".score-container");
        let restart = document.getElementById("restart");
        let userScore = document.getElementById("user-score");
        let startScreen = document.querySelector(".start-screen");
        let startButton = document.getElementById("start-button");
        let questionCount;
        let scoreCount = 0;
        let count = 11;
        let countdown;
        let arrayResult = [];
        //Questions and Options array
        let quizArray = [];

        $.ajax({
            url: "http://127.0.0.1:8000/getQuestionByLecture",
            type: "GET",

            data: {

                lessture_id: '{{$lessture_id}}',

            },
            success: function (response) {
                quizArray = response
            }
        });
        //Restart Quiz
        restart.addEventListener("click", () => {
            initial();
            displayContainer.classList.remove("hide");
            scoreContainer.classList.add("hide");
        });
        //Next Button
        nextBtn?.addEventListener(
            "click",
            (displayNext = () => {
                //increment questionCount
                questionCount += 1;
                //if last question
                if (questionCount == quizArray.length) {
                    //hide question container and display score
                    displayContainer.classList.add("hide");
                    scoreContainer.classList.remove("hide");
                    //user score
                    userScore.innerHTML =
                        "Số câu đúng " + scoreCount + " của tổng câu " + questionCount;
                    $.ajax({
                        url: "{{route('addAttempt')}}",
                        data: {

                            lessture_id: '{{$lessture_id}}',
                            total_score: scoreCount/questionCount*100,
                            student_id: '{{auth()->user()->id}}',
                        }


                    });
                } else {
                    //display questionCount
                    countOfQuestion.innerHTML =
                        questionCount + 1 + " trên " + quizArray.length + " Câu hỏi";
                    //display quiz
                    quizDisplay(questionCount);
                    count = 11;
                    clearInterval(countdown);

                }
                $("#next-button").hide()
                $("#check-button").show()


            })
        );

        //Timer

        //Display quiz
        const quizDisplay = (questionCount) => {
            let quizCards = document.querySelectorAll(".container-mid");
            //Hide other cards
            quizCards.forEach((card) => {
                card.classList.add("hide");
            });
            //display current question card
            quizCards[questionCount].classList.remove("hide");
        };

        //Quiz Creation
        function quizCreator() {
            //randomly sort questions
            quizArray.sort(() => Math.random() - 0.5);
            //generate quiz
            for (let i of quizArray) {
                //randomly sort options
                i.options.sort(() => Math.random() - 0.5);
                //quiz card creation
                let div = document.createElement("div");
                div.classList.add("container-mid", "hide");
                //question number
                countOfQuestion.innerHTML = 1 + " trên " + quizArray.length + " Câu hỏi";
                //question
                let question_DIV = document.createElement("p");
                question_DIV.classList.add("question");
                question_DIV.innerHTML = i.question;
                div.appendChild(question_DIV);
                //options
                div.innerHTML += `
    <button class="option-div" onclick="choose(this)">${i.options[0]}</button>
     <button class="option-div" onclick="choose(this)">${i.options[1]}</button>
      <button class="option-div" onclick="choose(this)">${i.options[2]}</button>
       <button class="option-div" onclick="choose(this)">${i.options[3]}</button>
    `;
                quizContainer.appendChild(div);
            }
        }

        let arr = []

        function choose(userOption) {
            arr[questionCount] = userOption.innerText
            $(".option-div").attr("class", "option-div")

            userOption.classList.toggle("choose");
        }

        checkBtn.addEventListener(
            "click",
            (displayNext = () => {

                //increment questionCount
                let number = $("#check-button").prev().prev().find($(".number-of-question")).text().split(" ")[0] - 1
                let arrCheck = []
                arrCheck.push($("#check-button").prev().children()[number].children[1].classList.value)
                arrCheck.push($("#check-button").prev().children()[number].children[2].classList.value)
                arrCheck.push($("#check-button").prev().children()[number].children[3].classList.value)
                arrCheck.push($("#check-button").prev().children()[number].children[4].classList.value)
                console.log(number, arrCheck)
                if (arrCheck.includes('option-div choose')) {
                    console.log('1')
                } else {
                    return false
                }

                let question =
                    document.getElementsByClassName("container-mid")[questionCount];
                let options = question.querySelectorAll(".option-div");
                //if last question
                console.log(quizArray[questionCount].correct)
                if (arr[arr.length - 1] === quizArray[questionCount].correct) {
                    $("#check-button").prev().find($(".option-div.choose"))[0].classList.add("correct");
                    scoreCount++;
                } else {
                    $("#check-button").prev().find($(".option-div.choose"))[0].classList.add("incorrect");
                    //For marking the correct option
                    options.forEach((element) => {
                        if (element.innerText == quizArray[questionCount].correct) {
                            element.classList.add("correct");
                        }
                    });
                }
                options.forEach((element) => {
                    element.disabled = true;
                });
                $("#check-button").hide()

                $("#next-button").show()
            })
        );

        //Checker Function to check if option is correct or not
        function checker(userOption) {

            let userSolution = userOption.innerText;
            let question =
                document.getElementsByClassName("container-mid")[questionCount];
            let options = question.querySelectorAll(".option-div");
            //if user clicked answer == correct option stored in object
            if (userSolution === quizArray[questionCount].correct) {
                userOption.classList.add("correct");
                scoreCount++;
            } else {
                userOption.classList.add("incorrect");
                //For marking the correct option
                options.forEach((element) => {
                    if (element.innerText == quizArray[questionCount].correct) {
                        element.classList.add("correct");
                    }
                });
            }
            //clear interval(stop timer)
            clearInterval(countdown);
            //disable all options
            options.forEach((element) => {
                element.disabled = true;
            });
        }

        //initial setup
        function initial() {
            quizContainer.innerHTML = "";
            questionCount = 0;
            scoreCount = 0;
            count = 11;
            clearInterval(countdown);

            quizCreator();
            quizDisplay(questionCount);
        }

        //when user click on start button
        startButton.addEventListener("click", () => {
            startScreen.classList.add("hide");
            displayContainer.classList.remove("hide");
            initial();
        });
        //hide quiz and display start screen
        window.onload = () => {
            startScreen.classList.remove("hide");
            displayContainer.classList.add("hide");
        };
    </script>
@endpush
