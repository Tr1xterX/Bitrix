<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

//массив с категориями и их символьными кодами
$sections = [
    '' => 'Все рубрики',
    'culture' => 'Культурные',
    'science' => 'Научные',
    'sport' => 'Спортивные'
];

// Получаем выбранный раздел из параметров компонента или из GET параметра
$selectedSection = isset($arParams['SELECTED_SECTION']) ? $arParams['SELECTED_SECTION'] : '';
?>

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







