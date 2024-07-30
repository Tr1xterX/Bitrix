<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="news-list">
    <?php foreach($arResult["ITEMS"] as $arItem): ?>
        <div class="news-item">
            <?php if($arItem["PREVIEW_PICTURE"]): ?>
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" class="img-responsive">
            <?php endif; ?>
            <h2><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a></h2>
            <p><?= $arItem["PREVIEW_TEXT"] ?></p>
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Читать далее</a>
        </div>
    <?php endforeach; ?>
</div>
