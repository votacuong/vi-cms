<?php
include(dirname(__FILE__).'/components/head.php');
?>
<body>
	<div class="container-scroller">
		<?php
			include(dirname(__FILE__).'/components/sidebar.php');
			
		?>
		<div class="container-fluid page-body-wrapper">
			<?php include(dirname(__FILE__).'/components/navbar.php'); ?>
			<div class="main-panel">
			  <div class="content-wrapper">
				<div class="row">
				  <?php 
				  include(dirname(__FILE__).'/components/breadcrumb.php');; 
				  include(dirname(__FILE__).'/'.$this->data['subview']); 
				  ?>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
	
    <script type="text/javascript">
	
		jQuery(document).ready(function(){
			
			typeof $.typeahead === 'function' && $.typeahead({
				input: ".js-typeahead",
				minLength: 1,
				order: "asc",
				group: true,
				maxItemPerGroup: 3,
				asyncResult: true,
				groupOrder: function (node, query, result, resultCount, resultCountPerGroup) {

					var scope = this,
						sortGroup = [];

					for (var i in result) {
						sortGroup.push({
							group: i,
							length: result[i].length
						});
					}

					sortGroup.sort(
						scope.helper.sort(
							["length"],
							false, // false = desc, the most results on top
							function (a) {
								return a.toString().toUpperCase()
							}
						)
					);

					return $.map(sortGroup, function (val, i) {
						return val.group
					});
				},
				hint: true,
				dropdownFilter: "All",
				href: "https://en.wikipedia.org/?title={{display}}",
				template: "{{display}}, <small><em>{{group}}</em></small>",
				emptyTemplate: "no result for {{query}}",
				source: {
					user: {
						dynamic: true,
						template: "{{firstname}} {{lastname}} ({{username}}), <small><em>{{group}}</em></small>",
						href: "<?php echo v_base_url('admin/user/edit');?>/{{id}}",
						data: [{
							"id": 415849,
							"username": "an inserted user that is not inside the database",
							"avatar": "https://avatars3.githubusercontent.com/u/415849"
						}],
						display: ['firstname'] ,
						ajax: {
							url: "<?php echo v_base_url('admin/user/search');?>?query={{query}}",
						}
					}
				},
				callback: {
					onClickAfter: function (node, a, item, event) {
						event.preventDefault();

						window.open(item.href);

						$('.js-result-container').text('');

					},
					onResult: function (node, query, obj, objCount) {

						var text = "";
						if (query !== "") {
							text = objCount + ' elements matching "' + query + '"';
						}
						$('.js-result-container').text(text);

					},
					onLayoutBuiltBefore: function (node, query, result, resultHtmlList) {
						if (!resultHtmlList
							|| !this.generateGroups.length
							|| this.displayEmptyTemplate
							|| this.generatedGroupCount === this.generateGroups.length
						) return;


						this.generateGroups.forEach(function (group) {
							if (!resultHtmlList.find('[data-search-group="' + group + '"]').length) {
								resultHtmlList.append('<li class="typeahead__group" data-search-group="' + group + '">\
										<a href="javascript:;" tabindex="-1">' + group + '</a>\
									</li>\
									<li class="typeahead__item" data-group="" data-index="-1">\
										<span style="padding: 0.5rem 0.75rem;display: block;">Loading...</span>\
									</li>'
								);
							}
						});

						return resultHtmlList;

					}
				},
				debug: true
			});
			
		});
		
	</script>
  </body>
</html>