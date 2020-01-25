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
                            <label for="email">
                                <strong>Email:</strong>
                            </label>
                            <input type="email" class="form-control"
                                   placeholder="Enter email"
                                   name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="state">
                                <strong>State:</strong>
                            </label>
                            <select class="form-control"
                                    id="state" name="state">
                                <option value="AK">AK</option>
                                <option value="AL">AL</option>
                                <option value="AR">AR</option>
                                <option value="AZ">AZ</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DC">DC</option>
                                <option value="DE">DE</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="IA">IA</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="MA">MA</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MO">MO</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="NC">NC</option>
                                <option value="ND">ND</option>
                                <option value="NE">NE</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NV">NV</option>
                                <option value="NY">NY</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VA">VA</option>
                                <option value="VT">VT</option>
                                <option value="WA">WA</option>
                                <option value="WI">WI</option>
                                <option value="WV">WV</option>
                                <option value="WY">WY</option>
                            </select>
                        </div>
                        <label for="seeking-group">
                            <strong>Seeking:</strong>
                        </label>
                        <div class="form-group form-check pl-0"
                             id="seeking-group">
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"
                                       value="Female">
                                Female
                            </label>
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"
                                       value="Male">
                                Male
                            </label>
                            <label for="seeking" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking"
                                       value="Other">
                                Other
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bio">
                                <strong>Biography:</strong>
                            </label>
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
