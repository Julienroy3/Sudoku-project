<!DOCTYPE html>
<html>
	
<?php require "header.php";
      include("connect.php");
    session_start(); 
    ?>

	<body>
        <?php require "menu.php";
        
        if (isset($_SESSION['IdUser'])){
            $req = $bdd->prepare("SELECT * FROM Utilisateur WHERE IdUser = :IdUser");
            $req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        }
        ?>
        
        <div class="wrap">
            <h1>SudokuJS demo with board generation</h1>

            <!-- Chronometre -->
            <div id="chronoExample">
                <div class="values" id="test2">00:00:00</div>
                <div>
                    <button class="startButton">Start</button>
                    <button class="pauseButton" >Pause</button>
                    <button class="stopButton">Stop</button>
                    <button class="resetButton">Reset</button>
                </div>
            </div>

            <!--show candidates toggle-->
            <label for="toggleCandidates">Show candidates </label><input id="toggleCandidates" class="js-candidate-toggle" type="checkbox"/>
            <!--genrate board btns-->
            New:
            <button type="button" class="js-generate-board-btn--easy">Easy</button>
            <button type="button" class="js-generate-board-btn--medium">Medium</button>
            <button type="button" class="js-generate-board-btn--hard">Hard</button>
            <button type="button" class="js-generate-board-btn--very-hard">Very Hard</button>


            <!--the only required html-->
            <div id="sudoku" class="sudoku-board">
            </div>

            <!--solve buttons-->
            Solve: <button type="button" class="js-solve-step-btn">One Step</button><button type="button" class="js-solve-all-btn">All</button>
            <br>


        </div>
        <!-- Form to push the values of time and level into the database if user is online -->
        <div class="modal">
            <div class="modal-form">
                <h2>Félicitations, tu as terminé le sudoku !</h2>
                <?php if(isset($_SESSION['IdUser'])) { ?>
                <form action="insertperf.php" method="post" class="addvalues">
                <?php } ?>
                <form class="addvalues">
                    <div id="timend"></div>
                    Ton temps : 
                    <input type="text" id="input-timend" name="time_end" value="" readonly="readonly" placeholder="">
                    <div id="level"></div>
                    <label>Le niveau du jeu : </label>
                    <input type="text" id="input-level" name="level" value="" readonly="readonly" placeholder=""><br>
                    <input type="submit" class="btn-validate" name="valid_in" value="Rejouer">
                </form>
            </div>
        </div>
            
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="sudokuJS.js"></script>
		<script type="text/javascript" src="easytimer.js"></script>
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
        
        
        // STOCKER LE SUDOKU DANS UNE VARIABLE, FAIRE AVEC JSON
        var bb = mySudokuJS.getBoard();
        //console.log(bb);
           var tabb = [];
           for(i=0; i < bb.length; i++){
               var ggg = bb[i].val;
               //console.log(ggg);
               if(ggg == null){
                   ggg = 0;
               }
               if(tabb.length < bb.length){
                   tabb.push(ggg);
               }
           }
           console.log(tabb);
           console.log(typeof tabb);
           
        
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
            $('.modal').addClass('active');
        }
	</script>
	</body>
</html>
