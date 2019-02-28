<?php require_once 'ViewHeaderPart.php'; ?>
<section class="section has-background-light" style="min-height: calc(100vh - 305px);">
    <div class="columns">
        <div class="column is-2 is-offset-2 has-background-grey-lighter	is-hidden-mobile">
            <aside class="menu">
                <p class="menu-label">
                    Newsy
                </p>
                <ul class="menu-list">
                    <li><a>Dodaj</a></li>
                    <li><a>Lista</a></li>
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
        <div class="column is-6 has-background-white">
            <?php
            if(!array_key_exists('news', params)) {
                echo '<div class="content has-text-centered"><h3 class="title is-4">Brak newsów do wyświetlenia lub edycji</h3></div>';
            }
            else {
                echo '<table class="table is-fullwidth"><thead><tr><th>Numer</th><th>Nazwa</th><th>Działanie</th></tr></thead>';
                foreach (params['news'] as $news) {
                    echo '<tr>
                            <td>'.$news['id'].'</td>
                            <td>'.$news['name'].'</td>
                            <td class="field is-grouped is-grouped-right"><div class="control"><button class="button is-small is-info">Edytuj</button></div><div class="control"><button class="button is-small is-danger">Usuń</button></div></td>
                          </tr>';
                }
                echo '</table>';
            }
            ?>

        </div>
    </div>

</section>

<footer class="footer">

</footer>
</body>
</html>
