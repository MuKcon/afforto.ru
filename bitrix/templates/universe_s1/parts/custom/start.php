<?php

use intec\Core;
use intec\core\base\InvalidParamException;
use intec\core\helpers\FileHelper;
use intec\core\helpers\Json;
use intec\core\helpers\Type;
use intec\constructor\Module as Constructor;
use intec\constructor\models\build\Template;

$request = Core::$app->request;
$session = Core::$app->session;
$variant = $request->get('variant');

if (!empty($variant)) {
    $file = __DIR__.'/variants/'.$variant.'.json';

    if (FileHelper::isFile($file)) {
        $values = FileHelper::getFileData($file);

        try {
            $values = Json::decode($values);
        } catch (InvalidParamException $exception) {}

        if (Type::isArray($values)) {
            $settings = $values;
            $session->set('settings', $settings);
            $page->getProperties()->setRange($settings);

            /** @var Template $template */
            $template = $build->getTemplate();

            if (empty($template))
                return;

            if (!Constructor::isLite())
                $template->populateRelation('build', $build);

            foreach ($settings as $key => $value)
                if (!$properties->exists($key))
                    $properties->set($key, $value);
        }
    }
}