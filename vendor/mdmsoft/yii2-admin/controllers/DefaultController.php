<?php

namespace mdm\admin\controllers;

use Yii;

/**
 * DefaultController
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class DefaultController extends \yii\web\Controller
{

    /**
     * Action index
     */
    // public function actionIndex($page = 'README.md')
    public function actionIndex()
    {
        // if (strpos($page, '.png') !== false) {
        //     $file = Yii::getAlias("@mdm/admin/{$page}");
        //     return Yii::$app->getResponse()->sendFile($file);
        // }
        return $this->redirect('/');
    }
}
