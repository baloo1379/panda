<?php require_once 'ViewHeaderPart.php'; ?>
<section class="section has-background-light" style="min-height: calc(100vh - 305px);">
    <div class="columns">
        <div class="column is-2 is-offset-1 has-background-grey-lighter	is-hidden-mobile">
            <aside class="menu">
                <p class="menu-label">
                    Newsy
                </p>
                <ul class="menu-list">
                    <li><a>Dodaj</a></li>
                    <li><a href="zaplecze">Lista</a></li>
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
                    <li><a>Dodaj</a></li>
                    <li class="is-active"><a>Lista</a></li>
                    <li><a>Edytuj konto</a></li>
                </ul>
            </div>
        </div>
        <div class="column is-8 has-background-white">
            <form action="update" method="post">
                <div class="field">
                    <label class="label">Nazwa</label>
                    <div class="control">
                        <input class="input" type="text" autocomplete="false" value="<?php echo params['name'] ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Opis</label>
                    <div class="control">
                        <textarea class="textarea" style="resize: vertical;"><?php echo params['description'] ?></textarea>
                    </div>
                </div>
                <div class="field">
                    <label class="checkbox">
                        <input type="checkbox" <?php echo params['checked'] ?>>
                        Widoczny
                    </label>
                </div>
                <div class="field">
                    <button class="button is-info">Zapisz</button>

                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
