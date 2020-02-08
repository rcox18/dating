<!--
    Robert Cox
	1/26/2020
	url: http://rcox.greenriverdev.com/IT328/dating/{view = /profile-form}
	The profile information form view for rcox.greenriverdev.com/IT328/dating.
	A dating website for monsters.
-->

<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <h1>Profile</h1>
            <form action="#" method="POST" class="col-12">
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">
                                <strong>Email: </strong>
                            </label>
                            <check if="{{ @errors['email'] }}">
                                <span class="err">{{ @errors['email'] }}</span>
                            </check>
                            <input type="text" class="form-control"
                                   placeholder="Enter email"
                                   name="email" id="email"
                                   value=" {{ @email }}">
                        </div>
                        <div class="form-group">
                            <label for="state">
                                <strong>State:</strong>
                            </label>
                            <check if="{{ @errors['state'] }}">
                                <span class="err">{{ @errors['state'] }}</span>
                            </check>
                            <select class="form-control"
                                    id="state" name="state">
                                <option value="none">--Select--</option>
                                <repeat group=" {{ @states }}" value=" {{ @currentState }}">
                                    <option value="{{ @currentState }}"
                                    <check if="{{ @currentState == @state }}">
                                        selected="selected"
                                    </check>>{{ @currentState }}</option>
                                </repeat>
                            </select>
                        </div>
                        <label for="seeking-group">
                            <strong>Seeking:</strong>
                        </label>
                        <check if="{{ @errors['seeking'] }}">
                            <span class="err">{{ @errors['seeking'] }}</span>
                        </check>
                        <div class="form-group form-check pl-0">
                            <repeat group="{{ @genders }}"
                                    key="{{ @key }}" value="{{ @value }}">
                                <label for="seeking-{{ @key }}"
                                       class="form-check-label ml-4">
                                <input class="form-check-input" type="radio"
                                       name="seeking" id="seeking-{{ @key }}"
                                       value="{{ @key }}"
                                        <check if="{{ @key == @seeking }}">
                                            checked="checked"
                                        </check>>
                                    {{ @value }}
                                </label>
                            </repeat>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bio">
                                <strong>Biography:</strong>
                            </label>
                            <textarea class="form-control rounded" rows="6"
                                      name="bio" id="bio">{{ @bio }}</textarea>
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
