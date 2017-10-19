</div>
        </div>

<footer class="navbar-fixed-bottom">
Lalala
</footer>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/sudokuJS.js"></script>
        <script type="text/javascript" src="js/easytimer.js"></script>
        <script>
        
        // Initialisation du chronomètre
        
        var timer = new Timer();
        timer.start();
        $('#chronoExample .startButton').click(function () {
            timer.start();
        });
        $('#chronoExample .pauseButton').click(function () {
            timer.pause();
        });
        $('#chronoExample .stopButton').click(function () {
            timer.stop();
        });
        $('#chronoExample .resetButton').click(function () {
            timer.reset();
        });
        timer.addEventListener('secondsUpdated', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });
        timer.addEventListener('started', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });
        timer.addEventListener('reset', function (e) {
            $('#chronoExample .values').html(timer.getTimeValues().toString());
        });
        
        
        // Initiate sudoku game
        
		var	$candidateToggle = $(".js-candidate-toggle"),
			$generateBoardBtnEasy = $(".js-generate-board-btn--easy"),
			$generateBoardBtnMedium = $(".js-generate-board-btn--medium"),
			$generateBoardBtnHard = $(".js-generate-board-btn--hard"),
			$generateBoardBtnVeryHard = $(".js-generate-board-btn--very-hard"),

			$solveStepBtn = $(".js-solve-step-btn"),
			$solveAllBtn = $(".js-solve-all-btn"),
			$clearBoardBtn = $(".js-clear-board-btn"),

			mySudokuJS = $("#sudoku").sudokuJS({
				difficulty: "easy"
				//change state of our candidate showing checkbox on change in sudokuJS
				,candidateShowToggleFn : function(showing){
					$candidateToggle.prop("checked", showing);
				}
                ,boardFinishedFn: function(data){
                    //var timesup = document.getElementById("test2").innerHTML;
                    //alert("Vous avez terminé votre sudoku en " + timesup);
                    //console.log(data);
                    //console.log(tt);
                    //$('#timend').text($(timesup));
                    popUp();
                },
			});

		$solveStepBtn.on("click", mySudokuJS.solveStep);
		$solveAllBtn.on("click", mySudokuJS.solveAll);
		$clearBoardBtn.on("click", mySudokuJS.clearBoard);

		$generateBoardBtnEasy.on("click", function(){
			mySudokuJS.generateBoard("easy");
            timer.reset();
		});
		$generateBoardBtnMedium.on("click", function(){
			mySudokuJS.generateBoard("medium");
            timer.reset();
		});
		$generateBoardBtnHard.on("click", function(){
			mySudokuJS.generateBoard("hard");
            timer.reset();
		});
		$generateBoardBtnVeryHard.on("click", function(){
			mySudokuJS.generateBoard("very hard");
            timer.reset();
		});

		$candidateToggle.on("change", function(){
			if($candidateToggle.is(":checked"))
				mySudokuJS.showCandidates();
			else
				mySudokuJS.hideCandidates();
		});
		$candidateToggle.trigger("change");
           
        
        // Show popup when game is finished
        
        var popUp = function(){
            // Put the finish time in the form 
            $('#timend').text(document.getElementById("test2").innerHTML);
            $('#input-timend').attr("placeholder", document.getElementById("test2").innerHTML);
            $('#input-timend').attr("value", document.getElementById("test2").innerHTML);
            // Grab the value of the finish time
            //var timesup = document.getElementById("test2").innerHTML;
            //console.log(timesup);
            //$('#timend').text($(timesup));
            
            // Find the level of the actual sudoku and return this into the form
            var data = mySudokuJS.analyzeBoard();
            $('#level').text(data.level);
            $('#input-level').attr("value", document.getElementById("level").innerHTML);
            
            // class form
            $('.popup').addClass('active');
            
        }
        
	</script>
    </body>
</html>