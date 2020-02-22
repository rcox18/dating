<!--
    Robert Cox
	1/26/2020
	url: http://rcox.greenriverdev.com/IT328/dating/{view = /personal-form}
	The personal information form page for rcox.greenriverdev.com/IT328/dating.
	A dating website for monsters.
-->

<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <h1>Personal</h1>
            <form action="#" method="POST" class="col-12">
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
                            <label for="first-name">
                                <strong>First Name: </strong>
                            </label>
                            <check if="{{ @errors['fName'] }}">
                                <span class="err">{{ @errors['fName'] }}</span>
                            </check>
                            <input type="text" class="form-control"
                                   placeholder="Enter first name"
                                   name="first-name" id="first-name"
                                   value="{{ @firstName }}">
                        </div>
                        <div class="form-group">
                            <label for="last-name">
                                <strong>Last Name: </strong>
                            </label>
                            <check if="{{ @errors['lName'] }}">
                                <span class="err">{{ @errors['lName'] }}</span>
                            </check>
                            <input type="text" class="form-control"
                                   placeholder="Enter last name"
                                   name="last-name" id="last-name"
                                   value="{{ @lastName }}">
                        </div>
                        <div class="form-group">
                            <label for="age">
                                <strong>Age: </strong>
                            </label>
                            <check if="{{ @errors['age'] }}">
                                <span class="err">{{ @errors['age'] }}</span>
                            </check>
                            <input type="number" class="form-control" id="age"
                                   placeholder="Enter age" name="age"
                                   value="{{ @age }}">
                        </div>
                        <label for="genders">
                            <strong>Gender: </strong>
                        </label>
                        <check if="{{ @errors['gender'] }}">
                            <span class="err">{{ @errors['gender'] }}</span>
                        </check>
                        <div class="form-group form-check pl-0" id="genders">
                            <repeat group="{{ @genders }}"
                                    key="{{ @key }}" value="{{ @value }}">
                                <label for="gender-{{ @key }}"
                                       class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="gender" id="gender-{{ @key }}"
                                       value="{{ @key }}"
                                        <check if="{{ @key == @gender }}">
                                        checked="checked"
                                        </check>>
                                    {{ @value }}
                                </label>
                            </repeat>
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                <strong>Phone Number: </strong>
                            </label>
                            <check if="{{ @errors['phone'] }}">
                                <span class="err">{{ @errors['phone'] }}</span>
                            </check>
                            <input type="text" class="form-control"
                                   placeholder="Enter phone number"
                                   id="phone" name="phone"
                                   value="{{ @phone }}">
                        </div>
                        <label for="premium">
                            <strong>Premium Membership: </strong>
                        </label>
                        <div class="form-check" id="premium-check">
                            <input type="checkbox" class="form-check-input" id="premium" name="premium" {{ @premium }}>
                            <label class="form-check-label" for="premium">Sign me up for a premium Account!</label>
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

