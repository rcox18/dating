<include href="php/htmlHead.php"></include>
    <include href="php/site-nav-bar.php"></include>
    <div class="container-fluid p-5">
        <div class="row p-3 border rounded">
            <div class="col-sm-6 order-sm-2">
                <div class="row">
                    <img src="images/smiley-monster.jpg" class="rounded"
                         alt="smiling monster">
                </div>
                <hr>
                <h3>Biography</h3>
                <p class="text-center">{{ @SESSION.bio }}</p>
            </div>
            <div class="col-sm-6 order-sm-1">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Name: {{ @SESSION.firstName }}
                            {{ @SESSION.lastName }}</li>
                        <li class="list-group-item">
                            Gender: {{ @SESSION.gender }}</li>
                        <li class="list-group-item">
                            Age: {{ @SESSION.age }}</li>
                        <li class="list-group-item">
                            Phone: {{ @SESSION.phone }}</li>
                        <li class="list-group-item">
                            Email: {{ @SESSION.email }}</li>
                        <li class="list-group-item">
                            State: {{ @SESSION.state }}</li>
                        <li class="list-group-item">
                            Seeking: {{ @SESSION.seeking }}</li>
                        <li class="list-group-item">
                            Interests: {{ @SESSION.interests }}</li>
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