<?php
/**
 * @copyright   Copyright (c) 2015, Addendio.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function awpp_search_plugins() {

?>


<div class="wrap"> <!-- START WRAP DIV -->

	<h2>Search Plugins with Addendio</h2>

					<div class="row"></div>
					<div role="tabpanel">
						<br>
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#search-tab" aria-controls="search" role="tab" data-toggle="tab">Search Plugins</a></li>
						<li role="presentation" ><a href="#newsletter-tab" aria-controls="newsletter" role="tab" data-toggle="tab">Newsletter</a></li>
						<li role="presentation" ><a href="#faq-tab" aria-controls="faq" role="tab" data-toggle="tab">FAQ</a></li>
						<li role="presentation"><a href="<?php echo AWPPT_ADMIN_FOLDER;?>themes.php?page=addendio-search-themes" aria-controls="themes" role="tab" >Search Themes</a></li>
					</ul>

					<!-- Tab panes -->

					<!-- START TAB-CONTENT DIV -->
					<div class="tab-content">

					<!-- START SEARCH TAB -->
					<div role="tabpanel" class="tab-pane active" id="search-tab">
					<div class="wrap">
					  <!-- Header -->
					 <header>

						  <div class="container">
							<div class="row">

							<!-- Logo -->
							<div class="col-md-2 col-xs-11" >
							  <a href="https://addendio.com/contact/?utm_source=plugin&utm_medium=plugins&utm_campaign=searchpage_logo" target="_blank" ><img id="logo" style="max-height:45px; max-width: 196px;" src="<?php echo AWPPT_PLUGIN_URL;?>assets/img/addendio_color_logo.png"/></a>
							</div>

							<!-- Search bar -->
							<div class="col-md-9 col-xs-11">
							  <div id="search_input" class="input-group input-lg m-t">
								<input type="text" name="q" id="q" autocomplete="off" spellcheck="false" autocorrect="false" class="form-control input-lg string"  placeholder="Search less, find more..."/>
								<span class="input-group-addon"><i id="input-loop" class="glyphicon glyphicon-search" style="color:#f5874f;"></i></span>
							  </div>
							</div>

						 </div>
						</div>
					  </header>
					  <!-- /Header -->


					  <!-- Main -->


					  <div class="container">
						<div class="row">


						  <!-- Left Column -->
						  <div class="col-md-2 col-xs-12 hidden-sm hidden-xs">
							<div class="main_caption">
							 Feedback? <a href="https://addendio.com/contact/?utm_source=plugin&utm_medium=plugins&utm_campaign=searchpage" target="_blank" >Get in touch <span class="glyphicon glyphicon-new-window" style="color:#f5874f;"></span></a>
							</div>
							<!-- Facets -->
							<div id="facets" class="hidden-sm hidden-xs"></div>

							  <br>
								<button class="btn btn-primary" type="button" id="reset-query" autofocus>
								  Reset Search
								</button>

						  </div>
						  <!-- /Left Column -->

						  <!-- Right Column -->
						  <div class="col-md-9 col-xs-11">

							<!-- Stats + sort order menu -->
							<div class="page-header">
							  <div class="pull-right sort-orders">
								<span id="sort-by" class="text-muted">Sort by:</span>
								<div class="btn-group">
								  <button id="sort-button" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span class="sort-by">Relevance</span> <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
									<li><a href="#" class="sortBy" data-index-suffix="">Relevance</a></li>
									<li><a href="#" class="sortBy" data-index-suffix="_installs_desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Installs</a></li>
									<li><a href="#" class="sortBy" data-index-suffix="_rating_desc"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span>Rating</a></li>
									</ul>
								</div>
							  </div>
							  <span id="stats"></span>
							  <div style="clear:both;"></div>
							</div>
							<!-- /Stats + sort order menu -->


							<!-- Hits -->
							<div id="hits"></div>
							<!-- /Hits -->

							<!-- Pagination -->
							<div id="pagination"></div>
							<!-- /Pagination -->

							<!-- /Right Column -->
						  </div>
						</div>
					  </div>
					  <!-- /Main -->



					   <!-- Facet template -->
					  <script type="text/template" id="facet-template">
						<div class="facet" >
						  <!-- facet title -->
						  <div class="page-header">
							<h5>{{ title }} <span class="glyphicon glyphicon-question-sign pull-right" data-toggle="tooltip" data-placement="left" title="{{facet_tooltip}}" style="color:#999;"></span></h5>
						  </div>
						  <ul class="list-unstyled2">
							{{#values}}
							 <li  class="list-unstyled4">
							 <!-- {{#refined}}class=" refined"{{/refined}} -->
							  {{#disjunctive}}
							  <input class="checkbox toggleRefine pull-left " data-facet="{{ facet }}" data-value="{{ value }}" type="checkbox" {{#refined}}checked="checked"{{/refined}}>
							  {{/disjunctive}}
							  <a class="facet_link toggleRefine pull-left " data-facet="{{ facet }}" data-value="{{ value }}" href="#">{{ label }}</a>
							  <small class="facet_count text-muted pull-right text-right">{{ count }}</small>
							</li>
							{{/values}}

							<!-- other values will only be displayed if the use click on the "show more" link  -->
							{{#has_other_values}}
							<!-- "show more" link -->
							<li class="show-more"><a href="#" onclick="showMoreLess(this); return false;"><i class="glyphicon glyphicon-chevron-down" /> more</a></li>

							<!-- other values -->
							{{#other_values}}
							<li class="{{#refined}}refined{{/refined}} additional-facets show-more">
							  {{#disjunctive}}
							  <input class="checkbox toggleRefine" data-facet="{{ facet }}" data-value="{{ value }}" type="checkbox" {{#refined}}checked="checked"{{/refined}}>
							  {{/disjunctive}}
							  <a class="facet_link toggleRefine" data-facet="{{ facet }}" data-value="{{ value }}" href="#">{{ label }}</a><small class="text-muted pull-right">{{ count }}</small>
							</li>
							{{/other_values}}

							<!-- "show less" link -->
							<li class="show-less" onclick="showMoreLess(this); return false;"><a href=""><i class="glyphicon glyphicon-chevron-up" /> less</a></li>
							{{/has_other_values}}
						  </ul>
						</div>
					  </script>

					  <!-- Slider template -->
					  <script type="text/template" id="slider-template">
						<div class="facet" id="{{ title }}1" >
							<div class="page-header">
							  <h5>{{ title }} <span class="glyphicon glyphicon-question-sign pull-right" data-toggle="tooltip" data-placement="left" title="{{facet_tooltip}}" style="color:#999;"></span></h5>
							</div>
						  <ul class="list-unstyled2">
							<li class="facet-slider">
							  <small class="pull-left text-muted">{{ label_min }}</small><small class="pull-right text-muted">{{label_max}}</small>
							  <input type="text" class="add_slider" data-slider-min="{{ min }}" data-slider-max="{{ max }}" data-slider-step="1" data-slider-value="[{{ values }}]" data-slider-orientation="horizontal" data-slider-selection="after" style="display:none;" id="{{ facet }}-slider" />
						  </li>
						  </ul>
						</div>

					  </script>

					  <!-- Hit template -->
					  <script type="text/template" id="hit-template">

						{{#source_wp_flag}}
									<div class="hit media" >
												{{#thumb_flag}}
													<img class="media-object pull-left" src="{{ img_thumb }}" style="width:128px;height:128px;" alt="{{ name }}" title="{{ name }}">
												{{/thumb_flag}}
									  <div class="media-body result-style" >
												<h4 class="hit_name text-left pull-left">{{{ _highlightResult.name.value }}} <small> by {{{author}}}</small></h4>
												<div class="btn-group pull-right btn-group-sm" >
															  <button  type="button"  class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
																More info<span class="caret"></span>
															  </button>
															  <ul class="dropdown-menu" role="menu">
																{{#homepage_flag}}
																	<li><a href="{{homepage}}" target="_blank" rel="nofollow" >Plugin's Homepage <span class="glyphicon glyphicon-new-window" style="color:#f5874f;"></span></a></li>
																{{/homepage_flag}}
																{{#author_href_flag}}
																	<li><a href="{{author_href}}" target="_blank" rel="nofollow" >View author's page <span class="glyphicon glyphicon-new-window" style="color:#f5874f;"></span></a></li>
																{{/author_href_flag}}
																<li><a class="thickbox" href="<?php echo AWPPT_ADMIN_FOLDER;?>plugin-install.php?tab=plugin-information&plugin={{ slug }}&TB_iframe=true&width={{page_width}}&height={{page_height}}">
																	{{#plugin_installed_flag}}
																		Info
																	{{/plugin_installed_flag}}
																	{{^plugin_installed_flag}}
																		Info + Install
																	{{/plugin_installed_flag}}
																	</a></li>
																<li><a href="https://wordpress.org/plugins/{{slug}}/" target="_blank" rel="nofollow" >View on WP.org <span class="glyphicon glyphicon-new-window" style="color:#f5874f;"></span></a></li>
																{{#donate_link_flag}}
																	<li><a  href="{{donate_link}}" target="_blank" rel="nofollow"  >Donate <span class="glyphicon glyphicon-new-window" style="color:#f5874f;"></span></a></li>
																{{/donate_link_flag}}
																</ul>
												</div>

												{{#plugin_installed_flag}}
													<div class="clearfix"></div>
													<p class=" pull-left" ><span class="label label-success pull-left" data-toggle="tooltip" data-placement="top" title="{{{name}}} already installed" >already installed</span><br/></p>
													<div class="clearfix"></div>
												{{/plugin_installed_flag}}
										<div class="clearfix"></div>

										 <p class="text-left pull-left">
										 {{{ _highlightResult.short_description.value }}}</p>
										{{#tags_flag}}
										<div class="clearfix"></div>
										<p class="text-left pull-left" >
											<span class="glyphicon glyphicon-tags" style="color:#f5874f;"></span> {{#_highlightResult.tags}}{{{ _highlightResult.tags.value }}}{{/_highlightResult.tags}}
										</p>
										{{/tags_flag}}
										<div class="clearfix"></div>
										<p class="text-left pull-left">
										<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Installs">Installs {{installs}}+</span>
											<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Version {{ version }}">Version {{ version }}</span>
											<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Requires WordPress to be > {{ requires }} ">WP>{{ requires }}</span>
											<span class="label label-{{last_update_label_color}}" data-toggle="tooltip" data-placement="top" title="Last update">Last update {{last_update_range}}</span>
											<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Created">Created {{added_range}}</span>
										</p>
										<div class="clearfix"></div>
										<p >
										{{{star_rating}}}
											<span class="label label-{{rating_label_color}}" data-toggle="tooltip" data-placement="top" title="Average rating">Rating {{rating}}</span>
											<span class="label label-{{num_ratings_label_color}}" data-toggle="tooltip" data-placement="top" title="Total number of votes">#Votes {{num_ratings}}</span>
									  	</p>
										</div> <!-- END media body div -->
									</div> <!-- END hit media div -->
							{{/source_wp_flag}}

					  </script>

					  <!-- Pagination template -->
					  <script type="text/template" id="pagination-template">
						<div class="text-center">
						  <ul class="pagination">
							<li {{^prev_page}}class="disabled"{{/prev_page}}><a href="#" {{#prev_page}} class="gotoPage" data-page="{{ prev_page }}" {{/prev_page}}>&#60;</a></li>
							{{#pages}}
							<li class="{{#current}}active{{/current}}{{#disabled}}disabled{{/disabled}}"><a href="#" {{^disabled}} class="gotoPage" data-page="{{ number }}" {{/disabled}}>{{ number }}</a></li>
							{{/pages}}
							<li {{^next_page}}class="disabled"{{/next_page}}><a href="#" {{#next_page}} class="gotoPage" data-page="{{ next_page }}" {{/next_page}}>&#62;</a></li>
						  </ul>
						</div>
					  </script>

					  <!-- Stats template -->
					  <script type="text/template" id="stats-template">
						<h5><b>{{ nbHits }}</b> PLUGIN{{#nbHits_plural}}S{{/nbHits_plural}} <span class="text-muted hidden-sm hidden-xs">found while you blinked</span></h5>
					  </script>
					</div><!--END WRAP DIV -->
						</div><!--END SEARCH TAB-->


					<!-- START FAQ TAB -->
					<div role="tabpanel" class="tab-pane" id="newsletter-tab">

						<h3>Newsletter</h3>
							If you are interested in receiving in your mailbox a recap of the latest plugins and other cool stuff you can subscribe to our newsletter (<em>NB the form below will open up a new tab</em>).
							<br/> We know you have enough emails to read. Be reassured we won't bother you with boring stuff.
							<br/><br/>
						<?php echo awppt_subscribe_newsletter();?>
					</div>
					<!-- END FAQ TAB -->


					<!-- START FAQ TAB -->
					<?php require_once  dirname(__FILE__) . '/awppt-static-text.php';?>
					<!-- END FAQ TAB -->

					</div>
					<!-- END TAB-CONTENT DIV -->
					</div>
					<!-- END TABPANEL DIV -->

</div>	<!-- END WRAP DIV -->

<?php

}
