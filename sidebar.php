<!-- Begin Sidebar -->
		<div id="sidebar">
			<div id="sidebar-inner">
				<ul>
                  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) : ?>
                     <!-- Widgets Go Here -->
                  <?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="clearboth"></div>
	</div>
<!-- End Sidebar -->