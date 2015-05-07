<div class="row content">
	<div class="col-md-12">

		<div class="row wrap-vertical">
			<ul id="nav-tabs" class="nav nav-tabs">
				<li class="active"><a href="#general" data-toggle="tab">General</a></li>
				<li><a href="#slides" data-toggle="tab">Slides</a></li>
				<li><a href="#layouts" data-toggle="tab">Layouts</a></li>
			</ul>
		</div>

		<form role="form" id="edit-form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo current_url(); ?>">
			<div class="tab-content">
				<div id="general" class="tab-pane row wrap-all active">
					<div class="form-group">
						<label for="input-title" class="col-sm-2 control-label">Title:</label>
						<div class="col-sm-5">
							<input type="text" name="title" id="input-title" class="form-control" value="<?php echo set_value('title', $title); ?>" />
							<?php echo form_error('title', '<span class="text-danger">', '</span>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Dimension:
							<span class="help-block">(H x W)</span>
						</label>
						<div class="col-sm-5">
							<div class="control-group control-group-2">
								<input type="text" name="dimension_h" class="form-control" value="<?php echo $dimension_h; ?>" />
								<input type="text" name="dimension_w" class="form-control" value="<?php echo $dimension_w; ?>" />
							</div>
							<?php echo form_error('dimension_h', '<span class="text-danger">', '</span>'); ?>
							<?php echo form_error('dimension_w', '<span class="text-danger">', '</span>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="input-effect" class="col-sm-2 control-label">Effect</label>
						<div class="col-sm-5">
							<select name="effect" id="input-effect" class="form-control">
								<?php foreach ($effects as $key => $value) { ?>
								<?php if ($value === $effect) { ?>
									<option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
								<?php } else { ?>
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
							<?php echo form_error('effect', '<span class="text-danger">', '</span>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="input-speed" class="col-sm-2 control-label">Transition Speed:
							<span class="help-block">(Slide transition speed)</span>
						</label>
						<div class="col-sm-5">
							<input type="text" name="speed" id="input-speed" class="form-control" value="<?php echo set_value('speed', $speed); ?>" />
							<?php echo form_error('speed', '<span class="text-danger">', '</span>'); ?>
						</div>
					</div>
				</div>

				<div id="slides" class="tab-pane row wrap-all">
					<ul class="thumbnail-list thumbnail-list-horizontal">
						<?php $slide_row = 0; ?>
						<?php foreach ($slides as $slide) { ?>
							<li id="image-row<?php echo $slide_row; ?>">
								<div class="col-md-1">
									<a class="btn btn-danger btn-lg" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a>
								</div>
								<div class="col-md-4">
									<div class="thumbnail imagebox">
										<div class="preview">
											<img src="<?php echo $slide['preview']; ?>" class="thumb img-responsive" id="thumb<?php echo $slide_row; ?>" /><br />
											<?php echo form_error('slides['.$slide_row.'][image_src]', '<span class="text-danger">', '</span>'); ?>
										</div>
										<div class="caption">
											<center class="name">
												<input type="text" class="form-control" name="slides[<?php echo $slide_row; ?>][name]" value="<?php echo $slide['name']; ?>" /><br />
												<?php echo form_error('slides['.$slide_row.'][name]', '<span class="text-danger">', '</span>'); ?>
											</center>
											<input type="hidden" name="slides[<?php echo $slide_row; ?>][image_src]" value="<?php echo $slide['image_src']; ?>" id="field<?php echo $slide_row; ?>" />

											<p>
												<a id="select-image" class="btn btn-primary" onclick="imageUpload('field<?php echo $slide_row; ?>');"><i class="fa fa-picture-o"></i></a>&nbsp;&nbsp;&nbsp;
											</p>
										</div>
									</div>
									</div>
								<div class="col-md-6">
									<textarea class="form-control" name="slides[<?php echo $slide_row; ?>][caption]" rows="8" cols="4"><?php echo $slide['caption']; ?></textarea><br />
									<?php echo form_error('slides['.$slide_row.'][caption]', '<span class="text-danger">', '</span>'); ?>
								</div>
							</li>
							<?php $slide_row++; ?>
						<?php } ?>
						<li id="add-image">
							<div class="thumbnail">
								<a class="btn btn-add-image" onclick="addSlide();"><i class="fa fa-plus"></i>&nbsp;<i class="fa fa-picture-o"></i></a>
							</div>
						</li>
					</ul>
				</div>

				<div id="layouts" class="tab-pane row wrap-all">
					<table class="table table-striped table-border table-sortable">
						<thead>
							<tr>
								<th class="action action-one"></th>
								<th>Layout</th>
								<th>Position</th>
								<th>Priority</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php $table_row = 0; ?>
							<?php foreach ($modules as $module) { ?>
							<tr id="module-row<?php echo $table_row; ?>">
								<td class="action action-one"><a class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a></td>
								<td><select name="layouts[<?php echo $table_row; ?>][layout_id]" class="form-control">
									<?php foreach ($layouts as $layout) { ?>
									<?php if ($layout['layout_id'] === $module['layout_id']) { ?>
										<option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
									<?php } else { ?>
										<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
									<?php } ?>
									<?php } ?>
									</select>
									<?php echo form_error('layouts['.$table_row.'][layout_id]', '<span class="text-danger small">', '</span>'); ?>
								</td>
								<td><select name="layouts[<?php echo $table_row; ?>][position]" class="form-control">
									<?php if ($module['position'] === 'top') { ?>
										<option value="top" selected="selected">Top</option>
									<?php } else { ?>
										<option value="top" selected="selected">Top</option>
									<?php } ?>
									</select>
									<?php echo form_error('layouts['.$table_row.'][position]', '<span class="text-danger small">', '</span>'); ?>
								</td>
								<td><input type="text" name="layouts[<?php echo $table_row; ?>][priority]" class="form-control" value="<?php echo $module['priority']; ?>" />
									<?php echo form_error('layouts['.$table_row.'][priority]', '<span class="text-danger small">', '</span>'); ?>
								</td>
								<td>
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										<?php if ($module['status'] === '1') { ?>
											<label class="btn btn-default" data-btn="btn-danger"><input type="radio" name="layouts[<?php echo $table_row; ?>][status]" value="0" <?php echo set_radio('layouts['.$table_row.'][status]', '0'); ?>>Disabled</label>
											<label class="btn btn-default active" data-btn="btn-success"><input type="radio" name="layouts[<?php echo $table_row; ?>][status]" value="1" <?php echo set_radio('layouts['.$table_row.'][status]', '1', TRUE); ?>>Enabled</label>
										<?php } else { ?>
											<label class="btn btn-default active" data-btn="btn-danger"><input type="radio" name="layouts[<?php echo $table_row; ?>][status]" value="0" <?php echo set_radio('layouts['.$table_row.'][status]', '0', TRUE); ?>>Disabled</label>
											<label class="btn btn-default" data-btn="btn-success"><input type="radio" name="layouts[<?php echo $table_row; ?>][status]" value="1" <?php echo set_radio('layouts['.$table_row.'][status]', '1'); ?>>Enabled</label>
										<?php } ?>
									</div>
									<?php echo form_error('layouts['.$table_row.'][status]', '<span class="text-danger small">', '</span>'); ?>
								</td>
							</tr>
							<?php $table_row++; ?>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr id="tfoot">
								<td class="action action-one"><a class="btn btn-primary btn-lg" onclick="addModule();"><i class="fa fa-plus"></i></a></td>
								<td colspan="4"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo root_url("assets/js/fancybox/jquery.fancybox.css"); ?>">
<script src="<?php echo root_url("assets/js/fancybox/jquery.fancybox.js"); ?>"></script>
<script type="text/javascript"><!--
function imageUpload(field) {
	$('#image-manager').remove();

	var iframe_url = js_site_url('image_manager?popup=iframe&field_id=') + encodeURIComponent(field);

	$('body').append('<div id="image-manager" style="padding: 3px 0px 0px 0px;"><iframe src="'+ iframe_url +'" width="980" height="550" frameborder="0"></iframe></div>');

	$.fancybox({
 		href:"#image-manager",
		autoScale: false,
		afterClose: function() {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: js_site_url('image_manager/resize?image=') + encodeURIComponent($('#' + field).attr('value')) + '&width=120&height=120',
					dataType: 'json',
					success: function(json) {
						var thumb = $('#' + field).parent().parent().find('.thumb');
						$(thumb).replaceWith('<img src="' + json + '" alt="" class="thumb img-responsive" />');
					}
				});
			}
		}
	});
};
//--></script>
<script type="text/javascript"><!--
var slide_row = <?php echo $slide_row; ?>;

function addSlide() {
	html  = '<li id="image-row' + slide_row + '">';
	html += '	<div class="col-md-1">';
	html += '		<a class="btn btn-danger btn-lg" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a>';
	html += '	</div>';
	html +=	'	<div class="col-md-4">';
	html += '		<div class="thumbnail imagebox">';
	html +=	'			<div class="preview">';
	html += '				<img src="<?php echo $no_photo; ?>" class="thumb img-responsive" id="thumb' + slide_row + '" />';
	html += '			</div>';
	html += '			<div class="caption">';
	html += '				<input type="hidden" name="slides[' + slide_row + '][image_src]" value="data/no_photo.png" id="field' + slide_row + '" />';
	html += '				<center class="name"><input type="text" class="form-control" name="slides[' + slide_row + '][name]" value="no_photo.png" /></center>';
	html += '				<p>';
	html += '					<a id="select-image" class="btn btn-primary" onclick="imageUpload(\'field' + slide_row + '\');"><i class="fa fa-picture-o"></i></a>&nbsp;&nbsp;&nbsp;';
	html += '				</p>';
	html += '			</div>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-md-6">';
	html += '		<textarea class="form-control" name="slides[' + slide_row + '][caption]" rows="11" cols="4"></textarea>';
	html += '	</div>';
	html += '</li>';

	$('.thumbnail-list #add-image').before(html);

	slide_row++;
}
//--></script>
<script type="text/javascript"><!--
var table_row = <?php echo $table_row; ?>;

function addModule() {
	html  = '<tr id="module-row' + table_row + '">';
	html += '	<td class="action action-one"><a class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a></td>';
    html += '<td><select name="layouts[' + table_row + '][layout_id]" class="form-control">';
		<?php foreach ($layouts as $layout) { ?>
			html += '<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
		<?php } ?>
    html += '</select></td>';
    html += '<td><select name="layouts[' + table_row + '][position]" class="form-control">';
		html += '<option value="right">Right</option>';
		html += '<option value="left">Left</option>';
		html += '<option value="top">Top</option>';
    html += '</select></td>';
	html += '	<td><input type="text" name="layouts[' + table_row + '][priority]" class="form-control" value="" /></td>';
	html += '   <td><div class="btn-group btn-group-toggle" data-toggle="buttons">';
	html += '   	<label class="btn btn-default active" data-btn="btn-danger"><input type="radio" name="layouts[' + table_row + '][status]" value="0" checked="checked">Disabled</label>';
	html += '   	<label class="btn btn-default" data-btn="btn-success"><input type="radio" name="layouts[' + table_row + '][status]" value="1">Enabled</label>';
	html += '   </div></td>';
	html += '</tr>';

	$('.table-sortable tbody').append(html);
	$('.btn-group-toggle input[type="radio"]:checked').trigger('change');

	$('#module-row' + table_row + ' select.form-control').select2();

	table_row++;
}
//--></script>