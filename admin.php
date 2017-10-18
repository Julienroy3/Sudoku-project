<!DOCTYPE html>
<html>
<?php include 'header.php';
      include 'menu.php';
?>
<body>
	<div class="wrap">
        <h1>Créer un concours</h1>
		<form action="contestBoard.php" method="post">
			Date du concours :<br />
			<input type="Date" name="dateContest" min="2017-01-01"><br />
			Heure de début :<br />
			<input type="Time" name="timeStart"><br />
			Heure de fin :<br />
			<input type="Time" name="timeEnd"><br />
			<br />
			<!-- generate buttons -->
            <input type="radio" class="js-generate-board-btn--easy" value="" id="btn-easy" name="level"><label for="btn-easy">Easy</label>
            <input type="radio" class="js-generate-board-btn--medium" value="" id="btn-medium" name="level"><label for="btn-medium">Medium</label>
            <input type="radio" class="js-generate-board-btn--hard" value="" id="btn-hard" name="level"><label for="btn-hard">Hard</label>
            <input type="radio" class="js-generate-board-btn--very-hard" value="" id="btn-vhard" name="level"><label for="btn-vhard">Very hard</label>
            <input type="text" id="solvedtab" value="">
            <br />

			<input type="submit" name="submit" value="Go">

		</form>
	</div>
	
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="sudokuJS.js"></script>
		<script type="text/javascript" src="easytimer.js"></script>
	   <script>
		var	$candidateToggle = $(".js-candidate-toggle"),
			$generateBoardBtnEasy = $(".js-generate-board-btn--easy"),
			$generateBoardBtnMedium = $(".js-generate-board-btn--medium"),
			$generateBoardBtnHard = $(".js-generate-board-btn--hard"),
			$generateBoardBtnVeryHard = $(".js-generate-board-btn--very-hard"),

			$solveStepBtn = $(".js-solve-step-btn"),
			$solveAllBtn = $(".js-solve-all-btn"),
			$clearBoardBtn = $(".js-clear-board-btn"),

			mySudokuJS = $("#sudoku").sudokuJS({
				candidateShowToggleFn : function(showing){
					$candidateToggle.prop("checked", showing);
				}
                ,boardFinishedFn: function(data){
                },
			});

		$generateBoardBtnEasy.on("click", function(){
			mySudokuJS.generateBoard("easy");
            gBoard();
		});
		$generateBoardBtnMedium.on("click", function(){
			mySudokuJS.generateBoard("medium");
            gBoard();
		});
		$generateBoardBtnHard.on("click", function(){
			mySudokuJS.generateBoard("hard");
            gBoard();
		});
		$generateBoardBtnVeryHard.on("click", function(){
			mySudokuJS.generateBoard("very hard");
            gBoard();
		});
           
           // This function allows to choose which level we want for the competition and returns 2 arrays : empty sudoku and solved sudoku
           var gBoard = function(){
                var board = mySudokuJS.getBoard();
               var emptySdk = [];
               var solvedSdk = [];
               for(i=0; i < board.length; i++){
                   var ggg = board[i].val;
                   if(ggg == null){
                       ggg = 0;
                   }
                   if(emptySdk.length < board.length){
                       emptySdk.push(ggg);
                   }

                   if(emptySdk.length >= board.length) {
                       mySudokuJS.solveAll(board);
                   }
               }
               if(emptySdk.length = 81){
                   for(j=0; j < board.length; j++){
                   var testTab = board[j].val;
                       if(solvedSdk.length < board.length){
                           solvedSdk.push(testTab);
                       }
                   }
               }
               
               $("#btn-easy").on('change', function () {
                  $(this).attr("value", emptySdk);
                  $('#solvedtab').attr("value", solvedSdk);
               });
               $("#btn-medium").on('change', function () {
                  $(this).attr("value", emptySdk);
                  $('#solvedtab').attr("value", solvedSdk);
               });
               $("#btn-hard").on('change', function () {
                  $(this).attr("value", emptySdk);
                  $('#solvedtab').attr("value", solvedSdk);
               });
               $("#btn-vhard").on('change', function () {
                  $(this).attr("value", emptySdk);
                  $('#solvedtab').attr("value", solvedSdk);
               });
               
               
           }
        
           var popUp = function(){};
	   </script>
    
    
</body>
</html>