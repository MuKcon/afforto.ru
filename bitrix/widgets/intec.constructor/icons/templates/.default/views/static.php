<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\Html;
/**
 * @var array $data
 */

?>
<div class="widget widget-icons widget-icons-default">
    <?php if ($data['header']['show'] && !empty($data['header']['value'])) { ?>
        <div class="widget-icons-header">
            <?= $data['header']['value'] ?>
        </div>
    <?php } ?>
    <?php if (!empty($data['items'])) { ?>
        <div class="widget-icons-items">
            <div class="widget-icons-items-wrapper" data-grid="<?= $data['count'] ?>">
                <?php foreach ($data['items'] as $item) { ?>
                    <div class="widget-icons-item">
                        <div class="widget-icons-item-content">
                            <div class="widget-icons-item-icon">
                                <?php if ($data['background']['show']) { ?>
                                    <?= Html::tag('div', null, [
                                        'class' => 'widget-icons-item-background',
                                        'style' => [
                                            'background-color' => !empty($data['background']['color']) ? $data['background']['color'] : null,
                                            'border-radius' => $data['background']['rounding']['top'].' '.$data['background']['rounding']['left'].' '.$data['background']['rounding']['right'].' '.$data['background']['rounding']['bottom'],
                                            'opacity' => $data['background']['opacity']
                                        ]
                                    ]) ?>
                                <?php } ?>
                                <?= Html::tag('div', null, [
                                    'class' => 'widget-icons-item-picture',
                                    'style' => [
                                        'background-image' => 'url(\''.$item['image'].'\')'
                                    ]
                                ]) ?>
                            </div>
                            <?php if (!empty($item['name'])) { ?>
                                <div class="intec-grid-item">
                                    <?= Html::tag('div', $item['name'], [
                                        'class' => 'widget-icons-item-name',
                                        'style' => [
                                            'font-size' => !empty($data['caption']['text']['size']) ? $data['caption']['text']['size'] : null,
                                            'font-style' => $data['caption']['style']['italic'] ? 'italic' : null,
                                            'font-weight' => $data['caption']['style']['bold'] ? '700' : null,
                                            'color' => !empty($data['caption']['text']['color']) ? $data['caption']['text']['color'] : null,
                                            'text-decoration' => $data['caption']['style']['underline'] ? 'underline' : null,
                                            'text-align' => !empty($data['caption']['text']['align']) ? $data['caption']['text']['align'] : null,
                                            'opacity' => !empty($data['caption']['opacity']) ? $data['caption']['opacity'] : null
                                        ]
                                    ]) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php unset($item) ?>
            </div>
        </div>
    <?php } ?>
</div>