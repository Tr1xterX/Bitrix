<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

// Получаем выбранный раздел
$selectedSection = isset($_GET['section']) ? $_GET['section'] : '';

// Определяем массив с категориями и их символьными кодами
$sections = [
    '' => 'Все рубрики',
    'culture' => 'Культурные',
    'science' => 'Научные',
    'sport' => 'Спортивные'
];

// Получение ID разделов по их символьным кодам
$sectionIDs = [];
$sectionList = CIBlockSection::GetList([], ['IBLOCK_ID' => $arParams['IBLOCK_ID']], false, ['ID', 'CODE']);
while($section = $sectionList->Fetch()) {
    $sectionIDs[$section['CODE']] = $section['ID'];
}
?>

<!-- Call to Action Section -->
<section class="page-section bg-dark text-white" id="news">
    <div class="container">
        <div class="row">
            <!-- Меню рубрикатор -->
            <div class="col-lg-3">
                <div class="menu-rubricator">
                    <ul class="nav flex-column nav-pills">
                        <?foreach ($sections as $sectionCode => $sectionName):?>
                            <li class="nav-item">
                                <a class="nav-link <?=($selectedSection == $sectionCode) ? 'active' : ''?>" href="?section=<?=$sectionCode?>">
                                    <?=$sectionName?>
                                </a>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
            <!-- Список новостей -->
            <div class="col-lg-9">
                <div class="container text-center">
                    <h2 class="mb-0">Новости</h2>
                    <hr class="divider my-4">
                </div>
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <? foreach ($arResult["ITEMS"] as $arItem): ?>
                            <?
                            // Проверка на соответствие выбранной категории
                            if ($selectedSection && $arItem["IBLOCK_SECTION_ID"] != $sectionIDs[$selectedSection]) {
                                continue;
                            }
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="col-lg-4 text-center">
                                <div class="card bg-secondary border border-dark">
                                    <img class="card-img-top" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                         alt="<? echo $arItem["NAME"] ?>">
                                    <div class="card-body ">
                                        <h5 class="card-title"><? echo $arItem["NAME"] ?></h5>
                                        <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                            <p class="card-text"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                                        <? endif; ?>
                                        <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-primary">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




