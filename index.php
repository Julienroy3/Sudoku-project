<?php include("header.php"); ?>

<div class="col-sm-12 wrap">
                
    <!-- Chronometre -->
    <div id="chronoExample">
        <div class="values" id="test2">00:00:00</div>
        <div>
            <button class="btn btn-default startButton">Start</button>
            <button class="btn btn-default resetButton">Reset</button>
        </div>
    </div>
                    
    <div class="col-sm-12 sudoku-c">
        <!--show candidates toggle-->
        <div class="show-candidates">
            <label for="toggleCandidates">De l'aide ?</label><input id="toggleCandidates" class="js-candidate-toggle" type="checkbox"/>
            
            <!--solve buttons-->
            <button type="button" class="btn btn-default js-solve-step-btn">Chiffre</button>
            <button type="button" class="btn btn-default js-solve-all-btn">Solution</button>
        </div>
                        
        <!--the only required html-->
        <div id="sudoku" class="sudoku-board"></div>
                        
        <div class="new-one">
            <span>Niveau</span><br>
            <button type="button" class="btn btn-default js-generate-board-btn--easy">Easy</button>
            <button type="button" class="btn btn-default js-generate-board-btn--medium">Medium</button>
            <button type="button" class="btn btn-default js-generate-board-btn--hard">Hard</button>
            <button type="button" class="btn btn-default js-generate-board-btn--very-hard">Very Hard</button>
        </div>
    </div>
                        
</div>

<!-- Form to push the values of time and level into the database if user is online -->
<div class="popup">
    <div class="popup-form">
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
                
<?php require("footer.php"); ?>            