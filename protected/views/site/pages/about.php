<?php
$this->pageTitle = Yii::app()->name . ' - About';
$this->breadcrumbs = ['About'];
?>
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
			<a href="https://auth0.com/blog/symfony-tutorial-building-a-blog-part-1/"><b>Symfonia</b></a></li>
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