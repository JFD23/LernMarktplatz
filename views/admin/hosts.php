<table class="default serversettings">
    <caption>
        <?= _("Lernmarktplatz-Server") ?>
    </caption>
    <thead>
        <tr>
            <th><?= _("Name") ?></th>
            <th><?= _("Adresse") ?></th>
            <th title="<?= _("Ein Hash des Public-Keys des Servers.") ?>"><?= _("Key-Hash") ?></th>
            <th style="text-align: center;"><?= _("Index-Server") ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($hosts as $host) : ?>
            <tr id="host_<?= $host->getId() ?>" data-host_id="<?= $host->getId() ?>">
                <td>
                    <? if ($host->isMe()) : ?>
                        <?= Icon::create("home", "info")->asImg(20, array('class' => "text-bottom", 'title' => _("Das ist Ihr Stud.IP"))) ?>
                    <? endif ?>
                    <?= htmlReady($host['name']) ?></td>
                <td>
                    <a href="<?= htmlReady($host['url']) ?>" target="_blank">
                        <?= Icon::create("link-extern", "clickable")->asImg(16, array('class' => "text-bottom")) ?>
                        <?= htmlReady($host['url']) ?>
                    </a>
                </td>
                <td>
                    <?= $host['public_key'] ? md5($host['public_key']) : "" ?>
                    <? if (strpos($host['public_key'], "\r") !== false) : ?>
                        <?= Assets::img("icons/20/red/exclaim", array('class' => "text-bottom", 'title' => _("Der Key hat ein Carriage-Return Zeichen, weshalb der Hash des Public-Keys vermutlich vom Original-Hash abweicht."))) ?>
                    <? endif ?>
                </td>
                <td style="text-align: center;" class="index_server">
                    <? if ($host->isMe()) : ?>
                        <a href="" title="<?= _("Als Index-Server aktivieren/deaktivieren") ?>" class="<?= $host['index_server'] ? "checked" : "unchecked" ?>">
                            <?= Icon::create("checkbox-".($host['index_server'] ? "" : "un")."checked", "clickable")->asImg(20) ?>
                        </a>
                    <? else : ?>
                        <? if ($host['index_server']) : ?>
                            <a href="" class="<?= $host['allowed_as_index_server'] ? "checked" : "unchecked" ?>">
                                <?= Icon::create("checkbox-".($host['allowed_as_index_server'] ? "" : "un")."checked", "clickable")->asImg(20) ?>
                            </a>
                        <? endif ?>
                    <? endif ?>
                </td>
                <td>
                    <? if (!$host->isMe()) : ?>
                        <a href="<?= PluginEngine::getLink($plugin, array(), "admin/ask_for_hosts/".$host->getId()) ?>" title="<?= _("Diesen Server nach weiteren bekannten Hosts fragen.") ?>">
                            <?= Icon::create($this->plugin->getPluginURL()."/assets/social_blue.svg", array('width' => "20px", 'class' => "text-bottom")) ?>
                        </a>
                    <? endif ?>
                </td>
            </tr>
        <? endforeach ?>
    </tbody>
</table>

<? if (count($hosts) < 2 && !$_SESSION['Lernmarktplatz_no_thanx']) : ?>
    <div id="init_first_hosts_dialog" style="display: none;">
        <form action="<?= PluginEngine::getLink($plugin, array(), "admin/add_new_host") ?>" method="post">
            <h2><?= _("Werden Sie Teil des weltweiten Stud.IP Lernmarktplatzes!") ?></h2>
            <div>
                <?= _("Der Lernmarktplatz ist ein Ort des Austauschs von kostenlosen und freien Lernmaterialien. Daher wäre es schade, wenn er nur auf Ihr einzelnes Stud.IP beschränkt wäre. Der Lernmarktplatz ist daher als dezentrales Netzwerk konzipiert, bei dem alle Nutzer aller Stud.IPs sich gegenseitig Lenrmaterialien tauschen können und nach Lernmaterialien anderer Nutzer suchen können. <i>Dezentral</i> heißt dieses Netzwerk, weil es nicht einen einzigen zentralen Server gibt, der wie eine große Suchmaschine alle Informationen bereit hält. Stattdessen sind im besten Fall alle Stud.IPs mit allen anderen Stud.IPs direkt vernetzt. So ein dezentrales Netz ist sehr ausfallsicher und es passt zur Opensource-Idee von Stud.IP, weil man sich von keiner zentralen Institution abhängig macht. Aber Ihr Stud.IP muss irgendwo einen ersten Kontakt zum großen Netzwerk aller Lernmarktplätze finden, um loslegen zu können. Wählen Sie dazu irgendeinen der unten aufgeführten Server aus. Sie werden Index-Server genannt und bilden das Tor zum Rest des ganzen Netzwerks. Achten Sie darauf, dass Sie mit mindestens einem, aber auch nicht zuvielen Indexservern verbunden sind.") ?>
            </div>

            <ul class="clean" style="text-align: center;">
                <li>
                    <?= \Studip\Button::create(_("Stud.IP Entwicklungsserver"), 'url', array('value' => "https://develop.studip.de/studip/plugins.php/lernmarktplatz/endpoints/")) ?>
                </li>
                <!--
                <li>
                    <?= \Studip\Button::create(_("blubber.it"), 'url', array('value' => "http://www.blubber.it/plugins.php/lernmarktplatz/endpoints/")) ?>
                </li>
                -->
                <li>
                    <?= \Studip\Button::create(_("Nein, danke!"), 'nothanx', array()) ?>
                </li>
            </ul>

        </form>
    </div>
    <script>
        jQuery(function () {
            jQuery('#init_first_hosts_dialog').dialog({
                'modal': true,
                'title': '<?= _("Index-Server hinzufügen") ?>',
                'width': "80%"
            });
        });
    </script>
<? endif ?>

<?
$actions = new ActionsWidget();
$actions->addLink(
    _("Server hinzufügen"),
    PluginEngine::getURL($plugin, array(), "admin/add_new_host"),
    Icon::create("add", "clickable"),
    array('data-dialog' => "1")
);

Sidebar::Get()->addWidget($actions);