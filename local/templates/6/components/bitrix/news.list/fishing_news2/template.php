<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

// Получаем выбранный раздел из параметра запроса 'section'
$selectedSection = isset($_GET['section']) ? $_GET['section'] : '';

// Массивы для хранения ID разделов по их символьным кодам и наоборот
$sectionIDs = [];
$sectionCodes = [];

// Получаем список разделов инфоблока
$sectionList = CIBlockSection::GetList([], ['IBLOCK_ID' => $arParams['IBLOCK_ID']], false, ['ID', 'CODE']);
while($section = $sectionList->Fetch()) {
    // Заполняем массивы для быстрого доступа к ID и символьным кодам разделов
    $sectionIDs[$section['ID']] = $section['CODE'];
    $sectionCodes[$section['CODE']] = $section['ID'];
}

// Функция для проверки, привязана ли новость к выбранному разделу
function isInSection($itemSections, $selectedSection, $sectionCodes) {
    // Если не выбран конкретный раздел, показываем все новости
    if (!$selectedSection) {
        return true;
    }
    // Проверяем, привязана ли новость к выбранному разделу
    foreach ($itemSections as $sectionID) {
        if ($sectionID == $sectionCodes[$selectedSection]) {
            return true;
        }
    }
    return false;
}
?>

<!-- Call to Action Section -->
<section class="page-section bg-dark text-white" id="news">
    <div class="container">
        <div class="row">
            <!-- Список новостей -->
            <div class="col-lg-12">
                <div class="container text-center">
                    <h2 class="mb-0">Новости</h2>
                    <hr class="divider my-4">
                </div>
                <div class="container text-center">
                    <div class="row justify-content-center">
                        <? foreach ($arResult["ITEMS"] as $arItem): ?>
                            <?
                            // Массив для хранения ID разделов, к которым привязана новость
                            $itemSections = [];
                            // Получаем группы (разделы) элемента
                            $rsSections = CIBlockElement::GetElementGroups($arItem['ID'], true, ['ID', 'IBLOCK_SECTION_ID']);
                            $primarySectionCode = ''; // Символьный код основного раздела
                            while ($arSection = $rsSections->Fetch()) {
                                // Заполняем массив ID разделов
                                $itemSections[] = $arSection['ID'];
                                // Сохраняем символьный код основного раздела
                                if ($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']) {
                                    $primarySectionCode = $sectionIDs[$arSection['ID']];
                                }
                            }

                            // Проверка, привязана ли новость к выбранному разделу
                            if (!isInSection($itemSections, $selectedSection, $sectionCodes)) {
                                continue; // Пропускаем новость, если она не привязана к выбранному разделу
                            }

                            // Добавление действий редактирования и удаления элемента
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                            // Формируем URL раздела для кнопки "Раздел новости"
                            $sectionUrl = '/korpach/?section=' . urlencode($primarySectionCode);
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
                                        <? if ($primarySectionCode): ?>
                                            <!-- Кнопка для перехода в раздел новости -->
                                            <a href="<?= $sectionUrl ?>" class="btn btn-secondary">Раздел новости</a>
                                        <? endif; ?>
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



