<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<link rel="stylesheet" media="all" type="text/css" href="sudokuJS.css">
		<link rel="stylesheet" media="all" type="text/css" href="fonts/stylesheet.css">
        <link rel="stylesheet" media="all" type="text/css" href="styles.css">

		<title>test</title>
	</head>

	<body>
        <?php require "menu.php"; ?>
        
        <div class="wrap">
            <h1>Créer un concours</h1>

            <!--<form action="adminform.php" method="post">-->
            <form>
                <div>
                    <!-- generate buttons -->
                    <input type="radio" class="js-generate-board-btn--easy" value="" id="btn-easy" name="level"><label for="btn-easy">Easy</label>
                    <input type="radio" class="js-generate-board-btn--medium" value="" id="btn-medium" name="level"><label for="btn-medium">Medium</label>
                    <input type="radio" class="js-generate-board-btn--hard" value="" id="btn-hard" name="level"><label for="btn-hard">Hard</label>
                    <input type="radio" class="js-generate-board-btn--very-hard" value="" id="btn-vhard" name="level"><label for="btn-vhard">Very hard</label>
                </div>
                    <input type="text" id="datepicker">
                <div>
                    
                </div>
                <input type="submit">
            </form>


            <!--the only required html
            <div id="sudoku" class="sudoku-board">
            </div>-->
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="sudokuJS.js"></script>
		<script type="text/javascript" src="easytimer.js"></script>
	   <script>
        
        // Initiate sudoku game
        //var board = 
        
		var	$candidateToggle = $(".js-candidate-toggle"),
			$generateBoardBtnEasy = $(".js-generate-board-btn--easy"),
			$generateBoardBtnMedium = $(".js-generate-board-btn--medium"),
			$generateBoardBtnHard = $(".js-generate-board-btn--hard"),
			$generateBoardBtnVeryHard = $(".js-generate-board-btn--very-hard"),

			$solveStepBtn = $(".js-solve-step-btn"),
			$solveAllBtn = $(".js-solve-all-btn"),
			$clearBoardBtn = $(".js-clear-board-btn"),

			mySudokuJS = $("#sudoku").sudokuJS({
                //board: board,
				//difficulty: "easy"
				//change state of our candidate showing checkbox on change in sudokuJS
				candidateShowToggleFn : function(showing){
					$candidateToggle.prop("checked", showing);
				}
                ,boardFinishedFn: function(data){
                    //var timesup = document.getElementById("test2").innerHTML;
                    //alert("Vous avez terminé votre sudoku en " + timesup);
                    //console.log(data);
                    //console.log(tt);
                    //$('#timend').text($(timesup));
                    //popUp();
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
        
        
        
           
           
           var gBoard = function(){
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
               var easy = function() {
                   $('#btn-easy').attr("value", tabb);
               }
               $('#btn-easy').click( function() {
                   
               });
               
               
           }
           
           
           //var board = [];
           //for(k=0 ; k < tabb.length; k++){
               //var fff = tabb[k].val;
               //console.log('fff = ' + fff);
              // if(board.length < tabb.length){
                //   board.push(fff);
              // }
           //}
           //console.log('test' + board);
           
           //mySudokuJS.setBoard(tabb);
           //console.log(mySudokuJS.setBoard(tabb));
          // var zeroboard = mySudokuJS.setBoard(tabb);
           //for(k=0 ; k < zeroboard.length; k++){
             //  var fff = zeroboard[k].val;
              // console.log('fff = ' + fff);
               
          // }
           
           
           //var pp = mySudokuJS.getBoard(tabb);
          // console.log(pp);
           //for(k=0; k < pp.length; k++){
             //  var ff = pp[k].val;
               //console.log(ff);
           //}
           
           //var board = mySudokuJS.getBoard(tabb);
        
	</script>
	</body>
</html>
