<?php
$this->showSideJournal = false;
$this->jsInclude[] = '<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>'."\n";
$this->pageTitle = (isset($attributes['journal_topic_name']) && !empty($attributes['journal_topic_name']['value'])) ? 'Тема номера «'.CHtml::encode($attributes['journal_topic_name']['value']).'» МАРКА '.CHtml::encode($journal->name) : 'МАРКА '.CHtml::encode($journal->name);
$this->pageDescription = 'Тема номера журнала МАРКА '.CHtml::encode($journal->name);
?>

<?php if (isset($attributes['journal_topic_name']) && !empty($attributes['journal_topic_name']['value'])){ ?>
<h1><?php echo CHtml::encode($attributes['journal_topic_name']['value']); ?></h1>
<?php } ?>

<div id="topic">
	<p class="muted">
		На странице предоставлена вырезка темы номера из журнала МАРКА (<?php echo $journal->name; ?>),<br />
		посмотреть <?php echo CHtml::link('полную версию выпуска можно по этой ссылке.',array('pages/view','type'=>'journal','id'=>$journal->id,'url'=>$journal->url),array('class'=>'dashed')); ?>
	</p>
	<div data-configid="<?php echo CHtml::encode($attributes['journal_topic_id']['value']); ?>" style="width:700px; height:495px;" class="issuuembed"></div>
</div><!-- /topic -->