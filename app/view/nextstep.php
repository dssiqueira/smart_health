
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--9-col">
		<h2>Next Steps</h2>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
		<img
			src="https://assets-cdn.github.com/images/modules/logos_page/Octocat.png"
			width="200px"></img>
	</div>
	<div class="mdl-cell mdl-cell--9-col">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Pellentesque tempus nunc non orci dictum, non ultricies turpis
			blandit. Fusce feugiat gravida dui, a facilisis mauris tristique vel.
			Praesent massa sem, egestas nec nibh pretium, fermentum mollis eros.
			Pellentesque mattis elementum purus nec varius. In eu mi varius,
			interdum velit ut, fringilla justo. Duis quis libero diam. Maecenas
			pretium interdum nisl viverra imperdiet. Vestibulum dui eros, blandit
			eu velit id, tempor efficitur est.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Pellentesque tempus nunc non orci dictum, non ultricies turpis
			blandit. Fusce feugiat gravida dui, a facilisis mauris tristique vel.
			Praesent massa sem, egestas nec nibh pretium, fermentum mollis eros.
			Pellentesque mattis elementum purus nec varius. In eu mi varius,
			interdum velit ut, fringilla justo. Duis quis libero diam. Maecenas
			pretium interdum nisl viverra imperdiet. Vestibulum dui eros, blandit
			eu velit id, tempor efficitur est.</p>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--9-col">
		<h2>What Are We Doing?</h2>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
		<img src="https://octodex.github.com/images/inspectocat.jpg"
			width="200px"></img>
	</div>
	<div class="mdl-cell mdl-cell--9-col">
		<ul class="demo-list-item mdl-list">
								<?php
								$json_file = @file_get_contents ( "https://api.github.com/repos/dssiqueira/runners/issues?state=open" );
								$json_str = json_decode ( $json_file, true );
								if (is_array ( $json_str )) {
									foreach ( $json_str as $e ) {
										echo '<li class="mdl-list__item"><span class="mdl-list__item-primary-content"><a href="' . $e ['url'] . '" target="_blank">' . $e ['title'] . '</a></span></li>';
									}
								} else {
									echo "Too bad! I couldn't load our list of issues....";
								}
								?>
							</ul>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--9-col">
		<h2>Version 2.0</h2>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
		<img src="https://octodex.github.com/images/octobiwan.jpg"
			width="200px"></img>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/laravel.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Laravel</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/angularjs.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Angular JS</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/materialangular.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Angular Material</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;"></div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/ranking.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Ranking</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/site.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Statistics by Site</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/multilanguage.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Multilanguage</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;"></div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/achievements.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Achievements</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/profile.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Profile Statistics</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--3-col">
		<div class="card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand"
				style="background: url('/img/events.png');"></div>
			<div class="mdl-card__supporting-text">
				<h2 class="mdl-card__title-text">Events Day</h2>
			</div>
			<div class="mdl-card__actions mdl-card--border">
				<button
					class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
					<i class="material-icons">-</i>
				</button>
				<span class="counter">(0)</span>
			</div>
		</div>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--9-col">
		<h2>The Future...</h2>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
		<img src="https://octodex.github.com/images/daftpunktocat-thomas.gif"
			width="200px"></img>
	</div>
	<div class="mdl-cell mdl-cell--9-col">
		<div class="countdown">
			<span id="clock" style="font-size: 40px;"></span>
		</div>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--9-col">
		<h2>Join the Force</h2>
	</div>
</div>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
		<img src="https://octodex.github.com/images/stormtroopocat.png"
			width="200px"></img>
	</div>
	<div class="mdl-cell mdl-cell--9-col">
		<button
			class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
			style="width: 480px; height: 150; color: #FFF;">YES!!!!!!!</button>
	</div>
</div>
