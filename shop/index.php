<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("shop");

// Получаем текущий раздел (если выбран)
$currentSectionCode = htmlspecialchars($_REQUEST["SECTION_CODE"]);
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Меню (рубрикатор) -->
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "news_rubricator",
                array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "1",
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_CODE" => "",
                    "COUNT_ELEMENTS" => "Y",
                    "TOP_DEPTH" => "1",
                    "SECTION_FIELDS" => array("ID", "NAME", "SECTION_PAGE_URL"),
                    "SECTION_USER_FIELDS" => array(),
                    "VIEW_MODE" => "LIST",
                    "SHOW_PARENT_NAME" => "Y",
                    "SECTION_URL" => "/news/?SECTION_CODE=#SECTION_CODE#",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y"
                ),
                false
            );
            ?>
        </div>
        <div class="col-md-9">
            <!-- Список новостей -->
            <?php
            $GLOBALS["arrFilter"] = array();
            if ($currentSectionCode) {
                $GLOBALS["arrFilter"]["SECTION_CODE"] = $currentSectionCode;
            }
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "news_list",
                array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "1",
                    "NEWS_COUNT" => "10",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter",
                    "FIELD_CODE" => array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"),
                    "PROPERTY_CODE" => array(),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "/news/#ELEMENT_ID#/",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => $currentSectionCode,
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "STRICT_SECTION_CHECK" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                ),
                false
            );
            ?>
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
