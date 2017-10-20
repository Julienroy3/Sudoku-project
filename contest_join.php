<?php include("header.php");
    
    $current = $_GET["idconcours"];
   // echo $current;
    
    $req = $bdd->prepare("SELECT * FROM Concours WHERE  Concours.IdConcours = :IdConcours");
    //$req->bindParam(":IdUser", $_SESSION["IdUser"], PDO::PARAM_INT);
    $req->bindParam(":IdConcours", $current, PDO::PARAM_INT);
    $req->execute();
    
    //while ($donnees = $req->fetch()){
        //echo $donnees["IdConcours"];
      //  echo $donnees["Temps"];
        //$donnees["GrilleConcours"];
    //}
    $donnees = $req->fetch();
?>
<div class="col-sm-12">
    <div class="col-md-3"></div>
    <div class="col-sm-12 col-md-6 text-center">
        <h1>Concours</h1>
                
        <!-- Chronometre -->
        <div id="chrono">
            <div class="values" id="test2">00:00:00</div>
        </div>
                
        <div id="sudoku" class="sudoku-board"></div>
                
    </div>
</div>
    
<!-- Form to push the values of time and level into the database if user is online -->
<div class="popup">
            <div class="popup-form">
                <h2>Félicitations, tu as terminé le concours !</h2>
                <form action="insertcontest.php" method="post" class="addvalues">
                    <div id="timend"></div>
                    Ton temps : 
                    <input type="text" id="input-timend" name="time_end" value="" readonly="readonly" placeholder="">
                    <input type="text" id="input-idconcours" name="id_concours" value="<?php echo $current; ?>" readonly="readonly" placeholder="">
                    <div id="level"></div>
                    <input type="submit" class="btn-validate" name="valid_in" value="Voir les résultats">
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
        
        var board = [<?php echo $donnees["GrilleConcours"]; ?>];
        
        
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
        
        var mySudokuJS = $("#sudoku").sudokuJS({
            board : competitionBoard,
            boardFinishedFn: function(data){
                popUp();
            },
        });
        
        
        // Show popup when game is finished
        
        var popUp = function(){
            // Put the finish time in the form 
            $('#timend').text(document.getElementById("chrono").innerHTML);
            $('#input-timend').attr("placeholder", document.getElementById("chrono").innerHTML);
            $('#input-timend').attr("value", document.getElementById("chrono").innerHTML);
            // Grab the value of the finish time
            //var timesup = document.getElementById("test2").innerHTML;
            //console.log(timesup);
            //$('#timend').text($(timesup));
            
            // Find the level of the actual sudoku and return this into the form
            var data = mySudokuJS.analyzeBoard();
            //$('#level').text(data.level);
            //$('#input-level').attr("value", document.getElementById("level").innerHTML);
            
            // class form
            $('.popup').addClass('active');
        }
        
        
    </script>

<?php include("footer.php"); ?>