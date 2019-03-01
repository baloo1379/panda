<?php require_once 'ViewHeaderPart.php'; ?>
<section class="section has-background-light" style="min-height: calc(100vh - 305px);">
    <div class="columns">
        <div class="column is-2 is-offset-1 has-background-grey-lighter	is-hidden-mobile">
            <aside class="menu">
                <p class="menu-label">
                    Newsy
                </p>
                <ul class="menu-list">
                    <li><a href="dodaj">Dodaj</a></li>
                    <li><a href="../zaplecze">Lista</a></li>
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
                    <li class="is-active"><a>Dodaj</a></li>
                    <li><a>Lista</a></li>
                    <li><a>Edytuj konto</a></li>
                </ul>
            </div>
        </div>
        <div class="column is-8 has-background-white">
            <form action="new" method="post">
                <input type="hidden" value="0" name="id">
                <div class="field">
                    <label class="label">Nazwa</label>
                    <div class="control">
                        <input class="input" type="text" autocomplete="false" placeholder="Tytuł..." name="name">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Opis</label>
                    <div class="control">
                        <textarea class="textarea" style="resize: vertical;" name="description" placeholder="Treść..."></textarea>
                    </div>
                </div>
                <div class="field">
                    <label class="checkbox">
                        <input type="checkbox" name="active">
                        Widoczny
                    </label>
                </div>
                <div class="field">
                    <input type="submit" class="button is-info" value="Dodaj">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
