<form action="<?= PluginEngine::getLink($plugin, array(), 'market/edit/'.$material->getId()) ?>" method="post" class="default" enctype="multipart/form-data">
    <label>
        <?= _("Name") ?>
        <input type="text" name="data[name]" value="<?= htmlReady($material['name']) ?>">
    </label>

    <label>
        <?= _("Kurzbeschreibung") ?>
        <input type="text" name="data[short_description]" value="<?= htmlReady($material['short_description']) ?>">
    </label>

    <label>
        <?= _("Beschreibung") ?>
        <textarea name="data[description]"><?= htmlReady($material['description']) ?></textarea>
    </label>

    <div style="margin-top: 10px;">
        <?= _("Themen (am besten mindestens 5)") ?>
        <ul class="clean lehrmarktplatz_tags" style="margin-top: 10px;">
            <? foreach ($material->getTopics() as $tag) : ?>
            <li>
                <?= Assets::img("icons/20/black/topic", array('class' => "text-bottom")) ?>
                <input type="text" name="tags[]" value="<?= htmlReady($tag['name']) ?>" style="max-width: calc(100% - 30px);">
            </li>
            <? endforeach ?>
            <li>
                <?= Assets::img("icons/20/black/topic", array('class' => "text-bottom")) ?>
                <input type="text" name="tags[]" value="<?= htmlReady($tag['name']) ?>" style="max-width: calc(100% - 30px);">
            </li>
        </ul>
    </div>

    <label class="file-upload" style="margin-top: 20px;">
        <?= _("Datei (gerne auch eine ZIP) ausw�hlen") ?>
        <input type="file" name="file"<? $material->isNew() ? "required" : "" ?>>
    </label>

    <label class="file-upload" style="margin-top: 20px;">
        <?= _("Logo-Bilddatei (optional)") ?>
        <input type="file" name="image" accept="image/*">
    </label>

    <? if ($material['front_image_content_type']) : ?>
        <label>
            <input type="checkbox" name="delete_front_image" value="1">
            <?= _("Logo l�schen") ?>
        </label>
    <? endif ?>

    <? if ($material->isNew()) : ?>
        <div style="margin-top: 20px;">
            <?= sprintf(
                _("Ich erkl�re mich bereit, dass meine Lehrmaterialien unter der %s Lizenz an alle Nutzer freigegeben werden. Ich best�tige zudem, dass ich das Recht habe, diese Dateien frei zu ver�ffentlichen, weil entweder ich selbst sie angefertigt habe, oder sie von anderen Quellen mit �hnlicher Lizenz stammen."),
                '<a href="http://creativecommons.org/licenses/by/4.0/" target="_blank">'.Assets::img("icons/16/blue/link-extern", array('class' => "text-bottom")).' CC BY 4.0</a>'
            ) ?>
        </div>
    <? endif ?>

    <div data-dialog-button>
        <?= \Studip\Button::create($material->isNew() ? _("Hochladen") : _("Speichern")) ?>
    </div>
</form>