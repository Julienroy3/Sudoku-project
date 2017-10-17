<!DOCTYPE html>
<html>
<?php include("connect.php");
      session_start(); 
      include 'header.php';
      include 'menu.php';
    
    $req = $bdd->prepare("SELECT * FROM Participe, Utilisateur, Concours WHERE Participe.IdUser = Utilisateur.IdUser AND Participe.IdConcours = Concours.IdConcours AND Classement = '1'");
    //$req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
    $req->execute();
    
?>
<body>
	<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 center">
                <h1>Concours</h1>
                
                <!-- Chronometre -->
                <div id="chrono">
                    <div class="values" id="test2">00:00:00</div>
                </div>
                
                <div id="sudoku" class="sudoku-board">
		        </div>
                
                
		  </div>
        </div>
        
        <div class="row winner-array">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="col-xs-6 col-md-6 winner-tab">Date</div>
                <div class="col-xs-6 col-md-6 winner-tab">Vainqueur</div>
                
                <?php
                    while ($donnees = $req->fetch()){
                ?>
                <div class="col-xs-6 col-md-6"><?php echo $donnees["DateConcours"]; ?></div>
                <div class="col-xs-6 col-md-6"><?php echo $donnees["username"]; ?></div>
                <?php
                    }
                ?>
            </div>
            <div class="col-md-3"></div>
        </div>
        
	</div>
    
    <!-- Form to push the values of time and level into the database if user is online -->
        <div class="modal">
            <div class="modal-form">
                <h2>Félicitations, tu as terminé le concours !</h2>
                <form action="insertcontest.php" method="post" class="addvalues">
                    <div id="timend"></div>
                    Ton temps : 
                    <input type="text" id="input-timend" name="time_end" value="" readonly="readonly" placeholder="">
                    <div id="level"></div>
                    <label>Ton classement : </label>
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
        timer.addEventListener('secondsUpdated', function (e) {
            $('#chrono').html(timer.getTimeValues().toString());
        });
        
        <?php echo 'test'; ?>
        
        var board = [
			 ,5, ,0, ,2,3,8,
			, ,1, , , ,4, , ,5
			, ,2, , ,5, , , ,
			,5, ,7,8, , ,2,1,
			,4,6, ,2,3,7, ,5,8
			, ,9,8, , ,5,4, ,7
			, , , , ,6, , ,4,
			,1, , ,9, , , ,6,
			, ,7,3,4, , , ,9,0
		];
        
        var lastCase = board[board.length - 1];
        console.log(lastCase);
        var competitionBoard = [];
        var length = board.length-1;
        
        //for(i=0; i<board.length; i++){
          //  if(board[i] == 0){
                //competitionBoard.push(null);
            //} else if(i = board[board.length - 1]) {
                  //competitionBoard.push(undefined);
            //} else {
              //  competitionBoard.push(board[i]);
            //}
        //}
        
        for(k=0; k<board.length; k++){
            if(board[k] == 0 && k !== length){
               // console.log('null');
                competitionBoard.push(null);
            } else if(k == length && board[k] == 0){
                //console.log('fini');
                competitionBoard.push(undefined);
            } else {
            competitionBoard.push(board[k]);
                
            }
        }
        
        console.log(board.length);
        console.log(competitionBoard.length);
        console.log(competitionBoard);
        
        //if(lastCase === 0){
          //  board.pop();
           // board.push(undefined);
        //}
        
        console.log(lastCase);
        
        
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
        
        
        var mySudokuJS = $("#sudoku").sudokuJS({
            board : competitionBoard,
            boardFinishedFn: function(data){
                popUp();
            },
        });
        
    </script>
    
</body>
</html>