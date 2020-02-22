<!--
    Robert Cox
	2/7/2020
	url: http://rcox.greenriverdev.com/IT328/dating/{view = /profile-summary}
	The profile summary page view for rcox.greenriverdev.com/IT328/dating.
	A dating website for monsters.
-->
<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <div class="col-sm-6 order-sm-2">
                <div class="row profile-img-div">
                    <check if="{{ @profileImage }}">
                        <true><img src="{{ @SESSION.profileImage }}"
                             class="rounded profile-img"
                             alt="Profile image" id="profile-pic"></true>
                        <false><img src="images/smiley-monster.jpg"
                                    class="rounded profile-img"
                                    alt="Profile image" id="profile-pic"></false>
                    </check>

                </div>
                <hr>
                <h3>Biography</h3>
                <p class="text-center">{{ @SESSION['user']->getBio() }}</p>
            </div>
            <div class="col-sm-6 order-sm-1">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Name: {{ @SESSION['user']->getFname() }}
                            {{ @SESSION['user']->getLname() }}</li>
                        <li class="list-group-item">
                            Gender: {{ ucfirst(@SESSION['user']->getGender()) }}</li>
                        <li class="list-group-item">
                            Age: {{ @SESSION['user']->getAge() }}</li>
                        <li class="list-group-item">
                            Phone: {{ @SESSION['user']->getPhone() }}</li>
                        <li class="list-group-item">
                            Email: {{ @SESSION['user']->getEmail() }}</li>
                        <li class="list-group-item">
                            State: {{ @SESSION['user']->getState() }}</li>
                        <li class="list-group-item">
                            Seeking: {{ ucfirst(@SESSION['user']->getSeeking()) }}</li>
                        <check if="{{ is_a(@SESSION.user, 'PremiumMember') }}">
                            <li class="list-group-item">
                            Interests: <repeat group="{{ @SESSION['user']->getIndoorInterests() }}" key="{{ @key }}" value="{{ @val }}">
                                        {{ @val }}
                                       </repeat>
                                       <repeat group="{{ @SESSION['user']->getOutdoorInterests() }}" key="{{ @key }}" value="{{ @val }}">
                                        {{ @val }}
                                       </repeat>
                            </li>
                        </check>


                    </ul>
                </div>
            </div>
            <div class="col order-sm-3 text-center mt-3">
                <a href="#" class=" btn btn-primary rounded"
                   id="contact-btn">
                    Contact Me!
                </a>
            </div>
        </div>
    </div>
<include href="php/htmlBSjsJQuery.php"></include>