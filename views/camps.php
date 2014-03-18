<!-- all html for page goes here -->

<section class="camp-header">
	<div class="container">
		<h3>The<br /><span class="sub">Camps</span></h3>
		<!--<h1>Lorem Ipsum Doloar sit amet,<br />Consectetur adipisicing elit, sed</h1>-->
		<p>For more than 14 years, Amanda Cromwell has run successful camps and clinics at Central Florida Soccer Academy and now at UCLA.  We have not only helped campers become better soccer players, but we have also impacted lives.  Our mission is to create a fun and encouraging - yet challenging - environment for all ages and skill levels.  Check out the options below and register before we reach capacity.  We hope to see you this summer!
		</p>

		<a href="#" class="cta scroll-arrow">
			<img src="/images/vector-arrow-down.png" class="vector-arrow" />
		</a>
		<img src="/images/img-soccerball.png" class="img-soccerball" />
	</div> <!--/container-->
</section>


<nav class="subnav">
	<ul class="container">
		<li <?php if($Model->subpage()=='academy' || $Model->subpage()==''){ echo 'class="active"'; } ?>><a href="/camps/academy">Amanda Cromwell Academy</a></li>
		<li <?php if($Model->subpage()=='central-florida-soccer-academy'){ echo 'class="active"'; } ?>><a href="/camps/central-florida-soccer-academy">Central Florida Soccer Academy</a></li>        
		<li <?php if($Model->subpage()=='ucla-camps'){ echo 'class="active"'; } ?>><a href="/camps/ucla-camps">UCLA Camps</a></li>
		<li <?php if($Model->subpage()=='coaching-education'){ echo 'class="active"'; } ?>><a href="/camps/coaching-education">Coaching Education</a></li>
	</ul>
</nav>


<section class="academy render">
	<!-- dynamically rendered -->
</section>

