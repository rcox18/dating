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
            <form action="#" class="col-12" method="POST">
                <hr>
                <div class="form-group">
                    <label for="indoor-interests">
                        <strong>In-door interests: </strong>
                    </label>
                    <check if="{{ @errors['indoor'] }}">
                        <span class="err">{{ @errors['indoor'] }}</span>
                    </check>
                    <div class="custom-control custom-checkbox"
                         id="indoor-interests">
                        <div class="row">
                            <repeat group="{{ @indoor }}"
                                    key="{{ @k }}" value="{{ @v }}">
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="{{ @k }}"
                                           name="indoor-interests[]"
                                           value="{{ @k }}"
                                    <check if="{{ is_array(@indoorInterests) AND in_array(@k, @indoorInterests) }}">
                                        checked="checked"
                                    </check>>
                                    <label class="custom-control-label"
                                           for="{{ @k }}">
                                        {{ @v }}
                                    </label>
                                </div>
                            </repeat>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="outdoor-interests">
                        <strong>Out-door interests:</strong>
                    </label>
                    <check if="{{ @errors['outdoor'] }}">
                        <span class="err">{{ @errors['outdoor'] }}</span>
                    </check>
                    <div class="custom-control custom-checkbox"
                         id="outdoor-interests">
                        <div class="row">
                            <repeat group="{{ @outdoor }}"
                                    key="{{ @k }}" value="{{ @v }}">
                                <div class="col-6 col-xs-4 col-sm-3">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="{{ @k }}"
                                           name="outdoor-interests[]"
                                           value="{{ @k }}"
                                    <check if="{{ is_array(@outdoorInterests) AND in_array(@k, @outdoorInterests) }}">
                                        checked="checked"
                                    </check>>
                                    <label class="custom-control-label"
                                           for="{{ @k }}">
                                        {{ @v }}
                                    </label>
                                </div>
                        </repeat>
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

