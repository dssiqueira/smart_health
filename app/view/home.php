
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col">
		<h4 class="home-text">One step at a time...</h4>
		<h2>First, Connect your App</h2>
		<h4 class="home-text">Before you start running, let us know how to track your
			statistics...</h4>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand" style="background: url('img/strava.png');"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text">Strava</h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<?php if($isStravaConnected !== FALSE) : ?>
			<form action="integration/disconnect" method="post">
				<input type="hidden" name="appid" value="<?php echo STRAVA_ID; ?>">
				<input type="submit" value="Disconnect"
					class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent ciandt-red">
			</form>
			<?php else : ?>
			<a href="https://www.strava.com/oauth/authorize?client_id=11678&response_type=code&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2Fintegration%2FsaveStrava&scope=write&state=mystate&approval_prompt=force"
			class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent ciandt-red">Connect</a>
			<?php endif; ?>                                                    
		</div>
	</div>
	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand" style="background: url('img/runkeeper.png');"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text">Runkeeper</h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<?php if($isRunkeeperConnected !== FALSE) : ?>
			<form action="integration/disconnect" method="post">
				<input type="hidden" name="appid"
					value="<?php echo RUNKEEPER_ID; ?>"> <input type="submit"
					value="Disconnect"
					class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent ciandt-red">
			</form>
			<?php else : ?>
		    <a href="https://runkeeper.com/apps/authorize?response_type=code&client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2Fintegration%2FsaveRunkeeper" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent ciandt-red">Connect</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title mdl-card--expand" style="background: url('img/nikerunning.png');"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text">Nike + Running</h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<button class="mdl-button mdl-js-button mdl-button--raised" disabled>Developing</button>
		</div>
	</div>
</div>

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col">
		<h2>Now, go outside and run!</h2>
		<h4 class="home-text">Run Forrest, Run!</h4>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col">
		<h2>Oh wait! Couldn't find your favorite app?</h2>
		<h4 class="home-text">So help us identify where to focus our efforts by voting on your favorite app below...</h4>
	</div>
</div>

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
<?php
$app_name = 'Google Fit';
$poll = $pollsModule->getVoteByUserIdAndPoll ( $user->id, $app_name );
$vote_count = $pollsModule->getCountOfVoteByPoll ( $app_name )->count;
$vote = isset ( $poll->vote ) ? $poll->vote : 0;
?>
		<div class="mdl-card__title mdl-card--expand" style="background: url('img/googlefit.png');"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text"><?php echo $app_name; ?></h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<form action="home/vote" method="post">
				<input type="hidden" name="poll" value="<?php echo $app_name; ?>">
                <?php if(empty($vote) || $vote == 0) : ?>
				<input type="hidden" name="vote" value="1">
				<input type="submit" value="+" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">
                <?php else : ?>
				<input type="hidden" name="vote" value="0">
				<input type="submit" value="-" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
				<?php endif; ?>                                
                <span class="counter">Votes (<?php print $vote_count; ?>)</span>
			</form>
		</div>
	</div>

	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
<?php
$app_name = 'Adidas Run';
$poll = $pollsModule->getVoteByUserIdAndPoll ( $user->id, $app_name );
$vote_count = $pollsModule->getCountOfVoteByPoll ( $app_name )->count;
$vote = isset ( $poll->vote ) ? $poll->vote : 0;
?>
		<div class="mdl-card__title mdl-card--expand" style="background: url('img/adidas.png');"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text"><?php echo $app_name; ?></h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<form action="home/vote" method="post">
				<input type="hidden" name="poll" value="<?php echo $app_name; ?>">
				<?php if(empty($vote) || $vote == 0) : ?>
				<input type="hidden" name="vote" value="1">
				<input type="submit" value="+" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
				<?php else : ?>
				<input type="hidden" name="vote" value="0">
				<input type="submit" value="-" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">
				<?php endif; ?>                                
				<span class="counter">Votes (<?php print $vote_count; ?>)</span>
			</form>
		</div>
	</div>


	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
<?php
	$app_name = 'MapMyRun';
	$poll = $pollsModule->getVoteByUserIdAndPoll ( $user->id, $app_name );
	$vote_count = $pollsModule->getCountOfVoteByPoll ( $app_name )->count;
	$vote = isset ( $poll->vote ) ? $poll->vote : 0;
?>
		<div class="mdl-card__title mdl-card--expand" style="<?php echo"background: url('img/" . strtolower($app_name) . ".png');"; ?>"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text"><?php echo $app_name; ?></h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<form action="home/vote" method="post">
				<input type="hidden" name="poll" value="<?php echo $app_name; ?>">
				<?php if(empty($vote) || $vote == 0) : ?>
				<input type="hidden" name="vote" value="1">
				<input type="submit" value="+" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">
				<?php else : ?>
				<input type="hidden" name="vote" value="0">
				<input type="submit" value="-" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">
				<?php endif; ?>                                
				<span class="counter">Votes (<?php print $vote_count; ?>)</span>
			</form>
		</div>
	</div>

</div>
<div class="mdl-grid">

	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
<?php
$app_name = 'Endomondo';
$poll = $pollsModule->getVoteByUserIdAndPoll ( $user->id, $app_name );
$vote_count = $pollsModule->getCountOfVoteByPoll ( $app_name )->count;
$vote = isset ( $poll->vote ) ? $poll->vote : 0;
?>
                            <div class="mdl-card__title mdl-card--expand" style="<?php echo"background: url('img/" . strtolower($app_name) . ".png');"; ?>"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text"><?php echo $app_name; ?></h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<form action="home/vote" method="post">
				<input type="hidden" name="poll" value="<?php echo $app_name; ?>">
                            <?php if(empty($vote) || $vote == 0) : ?>
									<input type="hidden" name="vote" value="1"> <input
					type="submit" value="+"
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
                            <?php else : ?>
									<input type="hidden" name="vote" value="0"> <input
					type="submit" value="-"
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
							<?php endif; ?>                                
                                    <span class="counter">Votes (<?php print $vote_count; ?>)</span>
			</form>
		</div>
	</div>


	<div class="mdl-cell mdl-cell--4-col card-square mdl-card mdl-shadow--2dp">
<?php
$app_name = 'Runtastic';
$poll = $pollsModule->getVoteByUserIdAndPoll ( $user->id, $app_name );
$vote_count = $pollsModule->getCountOfVoteByPoll ( $app_name )->count;
$vote = isset ( $poll->vote ) ? $poll->vote : 0;
?>
                            <div class="mdl-card__title mdl-card--expand" style="<?php echo"background: url('img/" . strtolower($app_name) . ".png');"; ?>"></div>
		<div class="mdl-card__supporting-text">
			<h2 class="mdl-card__title-text"><?php echo $app_name; ?></h2>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<form action="home/vote" method="post">
				<input type="hidden" name="poll" value="<?php echo $app_name; ?>">
                            <?php if(empty($vote) || $vote == 0) : ?>
									<input type="hidden" name="vote" value="1"> <input
					type="submit" value="+"
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
                            <?php else : ?>
									<input type="hidden" name="vote" value="0"> <input
					type="submit" value="-"
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab ciandt-red">								
							<?php endif; ?>                                
                                    <span class="counter">Votes (<?php print $vote_count; ?>)</span>
			</form>
		</div>
	</div>
</div>
