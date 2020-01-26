<!--
    Robert Cox
	1/26/2020
	url: http://rcox.greenriverdev.com/IT328/dating/{view = /interests-form}
	The interests information form page for rcox.greenriverdev.com/IT328/dating.
	A dating website for monsters.
-->

<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <h1>Interests</h1>
            <form action="profile-summary" class="col-12" method="POST">
                <hr>
                <div class="form-group">
                    <label for="indoor-interests">
                        <strong>In-door interests:</strong>
                    </label>
                    <div class="custom-control custom-checkbox"
                         id="indoor-interests">
                        <div class="row">
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="tv"
                                       name="indoor-interests[]"
                                       value="tv">
                                <label class="custom-control-label"
                                       for="tv">
                                    tv
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="movies"
                                       name="indoor-interests[]"
                                       value="movies">
                                <label class="custom-control-label"
                                       for="movies">
                                    movies
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="cooking"
                                       name="indoor-interests[]"
                                       value="cooking">
                                <label class="custom-control-label"
                                       for="cooking">
                                    cooking
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="board-games"
                                       name="indoor-interests[]"
                                       value="board games">
                                <label class="custom-control-label"
                                       for="board-games">
                                    board games
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="puzzles"
                                       name="indoor-interests[]"
                                       value="puzzles">
                                <label class="custom-control-label"
                                       for="puzzles">
                                    puzzles
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="reading"
                                       name="indoor-interests[]"
                                       value="reading">
                                <label class="custom-control-label"
                                       for="reading">
                                    reading
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="playing-cards"
                                       name="indoor-interests[]"
                                       value="playing cards">
                                <label class="custom-control-label"
                                       for="playing-cards">
                                    playing cards
                                </label>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-3">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="video-games"
                                       name="indoor-interests[]"
                                       value="video games">
                                <label class="custom-control-label"
                                       for="video-games">
                                    video games
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="outdoor-interests">
                        <strong>Out-door interests:</strong>
                    </label>
                        <div class="custom-control custom-checkbox"
                             id="outoor-interests">
                            <div class="row">
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="hiking"
                                           name="outdoor-interests[]"
                                           value="hiking">
                                    <label class="custom-control-label"
                                           for="hiking">
                                        hiking
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="biking"
                                           name="outdoor-interests[]"
                                           value="biking">
                                    <label class="custom-control-label"
                                           for="biking">
                                        biking
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="swimming"
                                           name="outdoor-interests[]"
                                           value="swimming">
                                    <label class="custom-control-label"
                                           for="swimming">
                                        swimming
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="collecting"
                                           name="outdoor-interests[]"
                                           value="collecting">
                                    <label class="custom-control-label"
                                           for="collecting">
                                        collecting
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="walking"
                                           name="outdoor-interests[]"
                                           value="walking">
                                    <label class="custom-control-label"
                                           for="walking">
                                        walking
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="climbing"
                                           name="outdoor-interests[]"
                                           value="climbing">
                                    <label class="custom-control-label"
                                           for="climbing">
                                        climbing
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="chasing"
                                           name="outdoor-interests[]"
                                           value="chasing">
                                    <label class="custom-control-label"
                                           for="chasing">
                                        chasing
                                    </label>
                                </div>
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="stalking"
                                           name="outdoor-interests[]"
                                           value="stalking">
                                    <label class="custom-control-label"
                                           for="stalking">
                                        stalking
                                    </label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">

                </div>
                <div class="form-group">
                    <button class="btn btn-primary rounded float-right"
                            type="submit">
                        Next>
                    </button>
                </div>
            </form>
        </div>
    </div>
<include href="php/htmlBSjsJQuery.php"></include>

