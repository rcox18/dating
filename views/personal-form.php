
<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <h1>Personal</h1>
            <form action="profile-form" method="POST" class="col-12">
                <hr>
                <div class="row">
                    <div class="col-sm-4 order-sm-12">
                        <p class="border-primary rounded p-2 text-center"
                           id="privacy-note">
                            <strong>Note:</strong> All information entered is
                           protected by our <a href="#">privacy policy</a>.
                           Profile information can only be viewed by others
                           with your permission.</p>
                    </div>
                    <div class="col-sm-8 order-sm-1">
                        <div class="form-group">
                            <label for="first-name">First Name:</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter first name"
                                   name="first-name" id="first-name">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name:</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter last name"
                                   name="last-name" id="last-name">
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age"
                                   placeholder="Enter age" name="age">
                        </div>
                        <div class="form-group form-check">
                            <label for="gender-m" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="gender" id="gender-m"> Female
                            </label>
                            <label for="gender-f" class="form-check-label ml-4">
                                <input for="gender" class="form-check-input" type="radio"
                                       name="gender" id="gender-f"> Male
                            </label>
                            <label for="gender-o" class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="gender" id="gender-o"> Other
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" class="form-control"
                                   placeholder="Enter phone number"
                                   id="phone" name="phone">
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

