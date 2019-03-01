<?php require_once 'ViewHeaderPart.php'; ?>
<section class="section has-background-light" style="min-height: calc(100vh - 305px);">
    <div class="columns">
        <div class="column is-2 is-offset-1 has-background-grey-lighter	is-hidden-mobile">
            <aside class="menu">
                <p class="menu-label">
                    Newsy
                </p>
                <ul class="menu-list">
                    <li><a href="zaplecze/dodaj">Dodaj</a></li>
                    <li><a href="">Lista</a></li>
                </ul>
                <p class="menu-label">
                    Konto
                </p>
                <ul class="menu-list">
                    <li><a>Edytuj</a></li>
                </ul>
            </aside>
        </div>
        <div class="column has-background-white is-hidden-tablet">
            <div class="tabs">
                <ul>
                    <li><a href="zaplecze/dodaj">Dodaj</a></li>
                    <li class="is-active"><a>Lista</a></li>
                    <li><a>Edytuj konto</a></li>
                </ul>
            </div>
        </div>
        <div class="column is-8 has-background-white">
            <?php
            if(!array_key_exists('news', params)) {
                echo '<div class="content has-text-centered"><h3 class="title is-4">Brak newsów do wyświetlenia lub edycji</h3></div>';
            }
            else {
                echo '<table class="table is-fullwidth"><thead><tr><th>Nr</th><th>Nazwa</th><th>Działanie</th></tr></thead>';
                foreach (params['news'] as $news) {
                    if($news['is_active']) $active = 'Wyłącz';
                    else $active = 'Włącz';
                    echo '<tr>
                            <td>'.$news['id'].'</td>
                            <td>'.$news['name'].'</td>
                            <td>
                                <div class="field has-addons has-addons-right">
                                    <div class="control"><button class="button is-small is-primary" onclick="toggleActive('.$news['id'].')" data-id="'.$news['id'].'" style="width: 58px;">'.$active.'</button></div>
                                    <div class="control"><a class="button is-small is-info" href="zaplecze/edit?id='.$news['id'].'" data-id="'.$news['id'].'" style="width: 58px;">Edytuj</a></div>
                                    <div class="control"><button class="button modal-button is-small is-danger" data-target="modal-confirm-deleting" data-id="'.$news['id'].'" aria-haspopup="true" style="width: 58px;">Usuń</button></div>
                                    
                                </div>
                            </td>
                          </tr>';
                }
                echo '</table>';
            }
            ?>

        </div>
    </div>

</section>
<div class="modal" id="modal-confirm-deleting">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Potwierdź operacje</p>
            <button id="delete" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <p>Na pewno chcesz usunąć ten element?</p>
        </section>
        <footer class="modal-card-foot">
            <button class="button cancel">Anuluj</button>
            <button class="button is-danger" onclick="deleteEl()">Ok</button>
        </footer>
    </div>
</div>
<footer class="footer">

</footer>
<script>
    function toggleActive(id) {
        let toggleForm = new FormData();
        toggleForm.append('news_id', id);
        let request = new XMLHttpRequest();
        request.open('POST', 'zaplecze/active');
        request.send(toggleForm);
        window.location = 'zaplecze';
    }

    function editEl(id) {
        let toggleForm = new FormData();
        toggleForm.append('news_id', id);
        let request = new XMLHttpRequest();
        request.open('POST', 'zaplecze/edit');
        request.send(toggleForm);
        window.location = 'zaplecze';
    }

    function deleteEl() {
        let id = document.getElementById('modal-confirm-deleting');
        id = id.dataset.id;

        let deleteForm = new FormData();
        deleteForm.append('news_id', id);
        let request = new XMLHttpRequest();
        request.open('POST', 'zaplecze/delete');
        request.send(deleteForm);
        window.location = 'zaplecze';
    }

    function openModal(target, id=0) {
        let $target = document.getElementById(target);
        document.documentElement.classList.add('is-clipped');
        $target.classList.add('is-active');
        $target.dataset.id = id;
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
                const target = el.dataset.target,
                    id = el.dataset.id;
                openModal(target, id);
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
