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
                    <li><a href="dodaj">Dodaj</a></li>
                    <li><a href="../zaplecze">Lista</a></li>
                    <li class="is-active"><a>Edytuj konto</a></li>
                </ul>
            </div>
        </div>
        <div class="column is-8 has-background-white">
            <form action="updateUser" method="post">
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" placeholder="jan.kowalski@domena.pl" name="email" autocomplete="false" id="email" disabled value="<?php echo params['email'] ?>">
                    </div>
                </div>
                <div class="field">
                    <label for="first_name" class="label">Imię</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Jan" name="first_name" id="first_name" required value="<?php echo params['fname'] ?>">
                    </div>
                </div>
                <div class="field">
                    <label for="last_name" class="label">Nazwisko</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Kowalski" name="last_name" id="last_name" required value="<?php echo params['lname'] ?>">
                    </div>
                </div>
                <div class="field">
                    <label for="gender" class="label">Płeć</label>
                    <div class="control">
                        <div class="select">
                            <select name="gender" id="gender">
                                <?php if(params['gender']){
                                    echo '<option value="k">Kobieta</option><option value="m" selected>Mężczyzna</option>';
                                } else {
                                    echo '<option value="k" selected>Kobieta</option><option value="m">Mężczyzna</option>';
                                } ?>

                            </select>
                        </div>

                    </div>
                </div>
                <div class="field">
                    <p class="control">
                        <input type="submit" class="button is-success" value="Zapisz">
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
