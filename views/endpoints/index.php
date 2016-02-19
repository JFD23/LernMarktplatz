<h1><?= _("Lehrmarktplatz") ?></h1>

<h2><?= _("Version") ?></h2>
<?= _("Stud.IP") ?>: <?= htmlReady($GLOBALS['SOFTWARE_VERSION']) ?>
<? $manifest = $this->plugin->getMetadata() ?>
<br>
<?= htmlReady($manifest['pluginname']) ?>: <?= htmlReady($manifest['version']) ?>

<h2><?= _("Public-Key") ?></h2>
<table class="default nohover">
    <tbody>
        <tr>
            <td><?= _("MD5-Hash") ?></td>
            <td><?= md5(MarketHost::thisOne()->public_key) ?></td>
        </tr>
        <tr>
            <td><?= _("Key") ?></td>
            <td><?= nl2br(htmlReady(MarketHost::thisOne()->public_key)) ?></td>
        </tr>
    </tbody>
</table>


<h2><?= _("Statistik") ?></h2>
<table class="default nohover">
    <tr>
        <td><?= _("Anzahl verbundener Server") ?></td>
        <td><?= MarketHost::countBySQL("1=1") - 1  ?></td>
    </tr>
    <tr>
        <td><?= _("Anzahl eigener Materialien") ?></td>
        <td><?= MarketMaterial::countBySQL("host_id IS NULL") ?></td>
    </tr>
    <tr>
        <td><?= _("Anzahl Materialien von anderen Servern") ?></td>
        <td><?= MarketMaterial::countBySQL("host_id IS NOT NULL") ?></td>
    </tr>
</table>

<h2><?= _("API-Endpoints") ?></h2>

<ul class="clean">
<? foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) : ?>
    <? if (stripos($method->name, "_action") === strlen($method->name) - 7) : ?>
        <? $name = substr($method->name, 0, stripos($method->name, "_action")) ?>
        <? if (!in_array($name, array("render", "map", "index"))) : ?>
            <li style="margin-bottom: 20px;">
                <? $name = substr($method->name, 0, stripos($method->name, "_action")) ?>
                <h3><?= htmlReady($name) ?></h3>
                <? $comment = $method->getDocComment() ?>
                <div>
                    <? $html_comment = "" ?>
                    <? foreach (explode("\n", $comment) as $line) {
                        $line = ltrim($line, " \t/*");
                        if (!trim($line)) {
                            $html_comment .= $line."\n\n";
                        } elseif ($line[0] === "@" && $html_comment[strlen($html_comment) - 1] !== "\n") {
                            $html_comment .= "\n".$line;
                        } else {
                            $html_comment .= $line." ";
                        }
                    } ?>
                    <?= formatReady(trim($html_comment)) ?>
                </div>
            </li>
        <? endif ?>
    <? endif ?>
<? endforeach ?>
</ul>