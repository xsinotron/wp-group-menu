<div class="module-settings-container">
    <div class="dialog-navigation">
        <h2>Paramétrages de l’emploi du temps 1 - Entrainements</h2>
        <button class="dashicons close-dialog" title="Fermer"></button>
        <button class="right dashicons" title="Suivant"><span class="screen-reader-text">Suivant</span></button>
        <button class="left dashicons" title="Précédent"><span class="screen-reader-text">Précédent</span></button>
    </div>
    <div class="module-settings-content-container">
        <div class="module-settings-content">
            <h3 class="nav-tab-wrapper" data-selected="">
                <a class="nav-tab nav-tab-general nav-tab-active" data-nav="general" href="?page=weekly-schedule&amp;settings=general&amp;schedule=1">Réglages</a>
                <a class="nav-tab nav-tab-categories" data-nav="categories" href="?page=weekly-schedule&amp;settings=categories&amp;schedule=1">Catégories</a>
                <a class="nav-tab nav-tab-items" data-nav="items" href="?page=weekly-schedule&amp;settings=items&amp;schedule=1">Horaires</a>
                <a class="nav-tab nav-tab-days" data-nav="days" href="?page=weekly-schedule&amp;settings=days&amp;schedule=1">Jours</a>
            </h3>
            <div class="tab-content general" style="display: block;">
                <h3>Réglages</h3>
                <form class="form-wrap" name="wsadminform" action="http://localhost/ymaa/wp-admin/admin.php?page=weekly-schedule" method="post" id="config">
                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="92c4472010"><input type="hidden" name="_wp_http_referer" value="/ymaa/wp-admin/admin.php?page=weekly-schedule&amp;settings=&amp;schedule=1">                    <!-- NAME -->
                    <div class="form-field">
                        <label>Nom</label>
                        <input type="text" id="schedulename" name="schedulename" size="80" value="Entrainements">
                    </div>
                    <!-- TIME RELATED SETTINGS -->
                    <fieldset>
                    <legend><strong>Paramétrages liés au temps</strong></legend>
                    <br>
                    <input type="hidden" name="schedule" value="1">
                    <table>
                        <tbody><tr>
                            <td>Agencement</td>
                            <td>
                                <select style="width: 200px" name="layout">
                                    <option value="horizontal">Horizontal</option>
                                    <option value="vertical">Vertical</option>
                                </select>
                            </td>
                            <td>Format d’affichage</td>
                            <td>
                                <select style="width: 200px" name="timeformat">
                                    <option value="24hours" selected="selected">24 heures (ex: 17h30)</option>
                                    <option value="24hourscolon">24 heures avec «:» (ex: 17:30)</option>
                                    <option value="12hours">12 heures (ex: 1:30pm)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Début</td>
                            <td>
                                <select style="width: 200px" name="starttime">
                                    <option value="0">0h00</option>
                                    <option value="0.5">0h30</option>
                                    <option value="1">1h00</option>
                                    <option value="1.5">1h30</option>
                                    <option value="2">2h00</option>
                                    <option value="2.5">2h30</option>
                                    <option value="3">3h00</option>
                                    <option value="3.5">3h30</option>
                                    <option value="4">4h00</option>
                                    <option value="4.5">4h30</option>
                                    <option value="5">5h00</option>
                                    <option value="5.5">5h30</option>
                                    <option value="6">6h00</option>
                                    <option value="6.5">6h30</option>
                                    <option value="7">7h00</option>
                                    <option value="7.5">7h30</option>
                                    <option value="8">8h00</option>
                                    <option value="8.5">8h30</option>
                                    <option value="9">9h00</option>
                                    <option value="9.5">9h30</option>
                                    <option value="10">10h00</option>
                                    <option value="10.5">10h30</option>
                                    <option value="11">11h00</option>
                                    <option value="11.5">11h30</option>
                                    <option value="12">12h00</option>
                                    <option value="12.5">12h30</option>
                                    <option value="13">13h00</option>
                                    <option value="13.5">13h30</option>
                                    <option value="14">14h00</option>
                                    <option value="14.5">14h30</option>
                                    <option value="15">15h00</option>
                                    <option value="15.5">15h30</option>
                                    <option value="16">16h00</option>
                                    <option value="16.5">16h30</option>
                                    <option value="17">17h00</option>
                                    <option value="17.5">17h30</option>
                                    <option value="18">18h00</option>
                                    <option value="18.5">18h30</option>
                                    <option value="19" selected="selected">19h00</option>
                                    <option value="19.5">19h30</option>
                                    <option value="20">20h00</option>
                                    <option value="20.5">20h30</option>
                                    <option value="21">21h00</option>
                                    <option value="21.5">21h30</option>
                                    <option value="22">22h00</option>
                                    <option value="22.5">22h30</option>
                                    <option value="23">23h00</option>
                                    <option value="23.5">23h30</option>
                                    <option value="24">24h00</option>
                                </select>
                            </td>
                            <td>Fin</td>
                            <td>
                                <select style="width: 200px" name="endtime">
                                    <option value="0">0h00</option>
                                    <option value="0.5">0h30</option>
                                    <option value="1">1h00</option>
                                    <option value="1.5">1h30</option>
                                    <option value="2">2h00</option>
                                    <option value="2.5">2h30</option>
                                    <option value="3">3h00</option>
                                    <option value="3.5">3h30</option>
                                    <option value="4">4h00</option>
                                    <option value="4.5">4h30</option>
                                    <option value="5">5h00</option>
                                    <option value="5.5">5h30</option>
                                    <option value="6">6h00</option>
                                    <option value="6.5">6h30</option>
                                    <option value="7">7h00</option>
                                    <option value="7.5">7h30</option>
                                    <option value="8">8h00</option>
                                    <option value="8.5">8h30</option>
                                    <option value="9">9h00</option>
                                    <option value="9.5">9h30</option>
                                    <option value="10">10h00</option>
                                    <option value="10.5">10h30</option>
                                    <option value="11">11h00</option>
                                    <option value="11.5">11h30</option>
                                    <option value="12">12h00</option>
                                    <option value="12.5">12h30</option>
                                    <option value="13">13h00</option>
                                    <option value="13.5">13h30</option>
                                    <option value="14">14h00</option>
                                    <option value="14.5">14h30</option>
                                    <option value="15">15h00</option>
                                    <option value="15.5">15h30</option>
                                    <option value="16">16h00</option>
                                    <option value="16.5">16h30</option>
                                    <option value="17">17h00</option>
                                    <option value="17.5">17h30</option>
                                    <option value="18">18h00</option>
                                    <option value="18.5">18h30</option>
                                    <option value="19">19h00</option>
                                    <option value="19.5">19h30</option>
                                    <option value="20">20h00</option>
                                    <option value="20.5">20h30</option>
                                    <option value="21">21h00</option>
                                    <option value="21.5">21h30</option>
                                    <option value="22" selected="selected">22h00</option>
                                    <option value="22.5">22h30</option>
                                    <option value="23">23h00</option>
                                    <option value="23.5">23h30</option>
                                    <option value="24">24h00</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Division des cellules temps                            </td>
                            <td>
                                <select style="width: 250px" name="timedivision">
                                    <option value="0.25">Quart d’heure</option>
                                    <option value=".50" selected="selected">Demi-heure</option>
                                    <option value="1.0">Heure</option>
                                    <option value="2.0">2 heures</option>
                                    <option value="3.0">trois heures</option>
                                </select>
                            </td>
                            <td>
                                Afficher les descriptions                            </td>
                            <td>
                                <select style="width: 200px" name="displaydescription">
                                    <option value="tooltip" selected="selected">Afficher comme une infobulle</option>
                                    <option value="cell">Afficher dans la cellule après le nom de l’élément</option>
                                    <option value="none">Ne pas afficher</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Liste des jours ( ID des jours à afficher séparés par un trait «-» )</td>
                            <td colspan="2"><input type="text" name="daylist" style="width: 200px" value=""> </td>
                        </tr>
                        <tr>
                            <td>Nom de la fenêtre de destination</td>
                            <td><input type="text" name="linktarget" style="width: 250px" value=""> </td>
                        </tr>
                    </tbody></table>
                    </fieldset>
                    <p style="border:0;" class="submit">
                        <input class="button button-primary" type="submit" name="submit" value="Mettre à jour »">
                    </p>
                </form>
            </div>
        </div>
        <div class="module-settings-content hidden hide">
            <h3 class="dialog-header">Security Check</h3>
            <div class="module-messages-container"></div>
            <div class="module-settings-content-main">
                <div class="settings-module-description"></div>
                <div class="settings-module-settings">
                    <div>
                        <p>When the button below is clicked the following modules will be enabled and configured:</p>
                        <ul class="list">
                            <li>
                                <p>Utilisateurs bannis</p>
                            </li>
                            <li>
                                <p>Sauvegarde de la base de données</p>
                            </li>
                            <li>
                                <p>Local Brute Force Protection</p>
                            </li>
                            <li>
                                <p>Network Brute Force Protection</p>
                            </li>
                            <li>
                                <p>Mots de passe forts</p>
                            </li>
                            <li>
                                <p>Modifications WordPress</p>
                            </li>
                        </ul>
                    </div>
                    <p><input value="Secure Site" class="button-primary" name="" id="" type="button"> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="dialog-content-footer">
        <button title="Valider" class="button button-primary align-left module-settings-valid">Valider</button>
        <button title="Annuler" class="button button-secondary align-right module-settings-cancel">Annuler</button>
    </div>
</div>
<script type="text/javascript" src="<?=plugins_url('wp-group-menu');?>/js/dialog.js"></script>
