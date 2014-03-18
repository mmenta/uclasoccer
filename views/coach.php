<!-- all html for page goes here -->

<section class="coach-header">
	<div class="container">
		<h1>Amanda<br />Cromwell</h1>
		<p>The Coach</p>
		<a href="#" class="cta scroll-arrow">
			<img src="/images/vector-arrow-down.png" class="vector-arrow" />
		</a>
	</div> <!--/container-->
</section>


<nav class="subnav">
	<ul class="container">
		<li <?php if($Model->subpage()=='accolades' || $Model->subpage()==''){ echo 'class="active"'; } ?>><a href="/coach/accolades">Accolades</a></li>
		<li <?php if($Model->subpage()=='about'){ echo 'class="active"'; } ?>><a href="/coach/about">About</a></li>
		<li <?php if($Model->subpage()=='videos'){ echo 'class="active"'; } ?>><a href="/coach/videos">Videos</a></li>
		<li <?php if($Model->subpage()=='social'){ echo 'class="active"'; } ?>><a href="/coach/social">Social</a></li>
	</ul>
</nav>

<section class="render">
	<!-- dynamically rendered -->
</section>

















