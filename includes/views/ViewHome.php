<?php require_once 'ViewHeaderPart.php'; ?>
<div class="modal" id="modal-login">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Login</p>
            <button id="delete" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <form action="login" method="post">
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Email" name="email" required autocomplete="false">
                        <span class="icon is-small is-left">
							<i class="fas fa-envelope"></i>
						</span>
                        <span class="icon is-small is-right">
							<i class="fas fa-check"></i>
						</span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password" required autocomplete="false">
                        <span class="icon is-small is-left">
							<i class="fas fa-lock"></i>
						</span>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button class="button is-success">
                            Login
                        </button>
                    </p>
                </div>
            </form>
        </section>
        <footer class="modal-card-foot">
            <button class="button cancel">Cancel</button>
        </footer>
    </div>
</div>
<div class="modal" id="modal-register">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Register</p>
            <button id="delete" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <!-- Content ... -->
        </section>
        <footer class="modal-card-foot">
            <button class="button cancel">Cancel</button>
        </footer>
    </div>
</div>
<section class="section has-background-light" style="min-height: calc(100vh - 305px);">
    <div class="columns">
        <div class="column is-half is-offset-one-quarter has-background-white">
                <?php
                    if(!array_key_exists('news', params)) {
                        echo '<div class="content has-text-centered"><h3 class="title is-4">Brak newsów do wyświetlenia</h3></div>';
                    }
                    else {
                        foreach (params['news'] as $news) {
                            echo "
                            <div class=\"box\">
                                <div class=\"content\">
                                    <p><strong>".$news['name']."</strong></p>
                                        ".$news['description']."
                                    <p><small>".$news['first_name']." ".$news['last_name']." <time>".$news['created_at']."</time></small>
                                    </p>
                                </div>
                            </div>";
                        }
                    }
                ?>

        </div>
    </div>

</section>
<footer class="footer">

</footer>
<script>
    function openModal(target) {
        let $target = document.getElementById(target);
        document.documentElement.classList.add('is-clipped');
        $target.classList.add('is-active');
    }

    function closeModal() {
        document.documentElement.classList.remove('is-clipped');
        let modals = [...document.getElementsByClassName('modal is-active')];
        modals.forEach(function(el) {
            el.classList.remove('is-active');
        });
    }

    document.addEventListener('DOMContentLoaded', function(){
        let modalBtns = [...document.getElementsByClassName('modal-button')];

        modalBtns.forEach(function(el){
            el.addEventListener('click', function(e) {
                const target = el.dataset.target;
                openModal(target);
                let closeModalBtn = document.getElementsByClassName('delete');
                let cancel = document.getElementsByClassName('cancel');
                let bg = document.getElementsByClassName('modal-background');
                let close = [...closeModalBtn, ...cancel, ...bg];
                close.forEach(function(el){
                    el.addEventListener('click', function(e) {
                        closeModal();
                    });
                });
            });
        });
    });
</script>
</body>
</html>
