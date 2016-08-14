<?php
/**
 * index.php
 *
 * @copyright Copyright &copy; Pedro Plowman, https://github.com/p2made, 2015
 * @author Pedro Plowman
 * @package p2made/yii2-sb-admin-theme
 * @license MIT
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Dashboard';

// being really pedantic about asset order...

p2made\assets\MorrisAsset::register($this);

p2made\theme\sbAdmin\demo\MorrisDemoAsset::register($this);
//p2made\assets\BootstrapPluginAsset::register($this);
//p2made\theme\sbAdmin\web\SBAdmin2Asset::register($this);
//p2made\assets\TimelineAsset::register($this);
//p2made\assets\MorrisAsset::register($this);
//p2made\assets\Html5shivAsset::register($this);
//p2made\assets\MetisMenuAsset::register($this);

//p2made\theme\sbAdmin\web\SBAdmin2UserAsset::register($this);
//p2made\theme\sbAdmin\web\SBAdmin2Asset::register($this);

// DEMO ONLY _DON'T_ use this in your production copy.
//p2made\demo\FlotDemoAsset::register($this);
//p2made\theme\sbAdmin\demo\MorrisDemoAsset::register($this);

/*
p2made\theme\sbAdmin\web\SBAdmin2Asset::register($this);
p2made\theme\sbAdmin\web\SBAdmin2UserAsset::register($this);
p2made\theme\sbAdmin\web\SBAdminAsset::register($this);

p2made\assets\AnimateAsset::register($this);
p2made\assets\BootstrapSocialAsset::register($this);
p2made\assets\DataTablesAsset::register($this);
p2made\assets\ExcanvasAsset::register($this);
p2made\assets\FlotChartsAsset::register($this);
p2made\assets\FlotTooltipAsset::register($this);
p2made\assets\FontAwesomeAsset::register($this);
p2made\assets\FullCalendarAsset::register($this);
p2made\assets\HolderAsset::register($this);
p2made\assets\IsotopeAsset::register($this);
p2made\assets\MetisMenuAsset::register($this);
p2made\assets\MomentAsset::register($this);
p2made\assets\MomentTimezoneAsset::register($this);
p2made\assets\MorrisAsset::register($this);
p2made\assets\PrettyPhotoAsset::register($this);
p2made\assets\PrettySociableAsset::register($this);
p2made\assets\RaphaelAsset::register($this);
p2made\assets\SweetAlertAsset::register($this);
p2made\assets\TimelineAsset::register($this);
p2made\assets\Html5shivAsset::register($this);

		'p2made\assets\AnimateAsset',
		'p2made\assets\BootstrapSocialAsset',
		'p2made\assets\DataTablesAsset',
		'p2made\assets\ExcanvasAsset',
		'p2made\assets\FlotChartsAsset',
		'p2made\assets\FlotTooltipAsset',
		'p2made\assets\FontAwesomeAsset',
		'p2made\assets\FullCalendarAsset',
		'p2made\assets\HolderAsset',
		'p2made\assets\IsotopeAsset',
		'p2made\assets\MetisMenuAsset',
		'p2made\assets\MomentAsset',
		'p2made\assets\MomentTimezoneAsset',
		'p2made\assets\MorrisAsset',
		'p2made\assets\PrettyPhotoAsset',
		'p2made\assets\PrettySociableAsset',
		'p2made\assets\RaphaelAsset',
		'p2made\assets\SweetAlertAsset',
		'p2made\assets\TimelineAsset',
		'p2made\assets\Html5shivAsset',
 */
?>
