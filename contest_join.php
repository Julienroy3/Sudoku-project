<?php require("header.php");

//participate to a contest

    $current = intval($_GET["idconcours"]);

    $req = $bdd->prepare("SELECT * FROM Concours WHERE  Concours.IdConcours = :IdConcours");

    $req->bindParam(":IdConcours", $current, PDO::PARAM_INT);

    $req->execute();

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
        <script type="text/javascript" src="js/sudokuJS.js"></script>
        <script type="text/javascript" src="js/easytimer.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

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


            // Find the level of the actual sudoku and return this into the form

            var data = mySudokuJS.analyzeBoard();

            // class form

            $('.popup').addClass('active');

        }



    </script>

<?php require("footer.php"); ?>
