<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="news-rubricator">
    <ul class="list-group">
        <?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
            <li class="list-group-item">
                <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["NAME"] ?> (<?= $arSection["ELEMENT_CNT"] ?>)</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
