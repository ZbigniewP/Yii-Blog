<?php
$this->pageTitle = Yii::app()->name . ' - About';
$this->breadcrumbs = ['About'];
?>
<div class="span-18">
	<h1>About</h1>

	<p>This is the "about" page for my blog site.</p>

	<dl><dt>Celem aplikacji jest pokazanie jak można przenieść aplikację z innego frameworka.</dt>
	<dd>Aplikacja wykorzystuje przykłady tworzenia blogu z wykorzystaniem
		<b>SQLite</b>.
		<br /> Szczegóły znajdują się na stronych frameworków:
	</dd><ul>
			<li>
				<a href="https://www.yiiframework.com/doc/blog/1.1/pl/start.design"><b>yii</b></a></li>
			<li>
				<a href="https://book.cakephp.org/3.0/en/tutorials-and-examples/blog/blog.html"><b>CakePHP</b></a></li>
			<li>
				<a href="https://auth0.com/blog/symfony-tutorial-building-a-blog-part-1/"><b>Symfony</b></a></li>
		</ul>
	</dl>
	<dl><dt>Podzielona jest na 3 etapy:</dt>
		<ol>
			<li>
				<b>stworzenie</b> - aplikacja odczytu danych dla 3 schematów baz danych na przyładzie z yii</li>
			<li>
				<b>konwersja</b> - schemat kodu kontrolera i interfejsu tak jak w wymienionych przykładach zgodnie z założeniami.</li>
			<li>
				<b>optymalizacja</b> - poprawienie formularzy, interfejsów, nazw konrolerów a szczególnie routingu</li>
		</ol>
	</dl>
</div>
<div class="span-5 last">
	<div class="portlet">
	<div class="portlet-decoration"><div class="portlet-title">Symfony Demo</div></div>
	<div class="portlet-content">
	<div class="section about">
		<div class="well well-lg">
			<p>
				<?= Yii::t('messages', 'help.app_description')?>
			</p>
			<p>
				<?= Yii::t('messages', 'help.more_information')?>
			</p>
		</div>
	</div>
	<!-- <?= strftime('%c %Z') ?>
	<?= date('d-M-Y H:i:s T') ?>
	<?= gmdate('d-M-Y H:i:s T') ?>
	<?= gmdate('c') ?>
	<?= CTimestamp::formatDate('d-M-Y H:i:s T') ?> -->
	<?php
	Yii::app()->format->dateFormat = 'long';
	Yii::app()->format->timeFormat = 'full';
	?>
	<!-- {# it's not mandatory to set the timezone in localizeddate(). This is done to
	avoid errors when the 'intl' PHP extension is not available and the application
	is forced to use the limited "intl polyfill", which only supports UTC and GMT #} -->
	<!-- Fragment rendered on <?= Yii::app()->format->datetime(time()) ?> -->
	</div>
	</div>
</div>