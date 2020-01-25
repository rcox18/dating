
<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <h1>Profile</h1>
            <form action="interests-form" method="POST" class="col-12">
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control"
                                   placeholder="Enter email"
                                   name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <select class="form-control" id="state">
                                <option>1</option><option>2</option>
                                <!--use loop with state array.php-->
                            </select>
                        </div>
                        <label for="seeking-group">Seeking:</label>
                        <div class="form-group form-check pl-0"
                             id="seeking-group">
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"> Female
                            </label>
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"> Male
                            </label>
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"> Other
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bio">Biography:</label>
                            <textarea class="form-control rounded" rows="6"
                                      name="bio" id="bio"></textarea>
                        </div>
                    </div>
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
