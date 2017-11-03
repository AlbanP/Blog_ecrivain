<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="dataConfirmLabel">' + title + ' "' + name + '"</h3>
			</div>
			<div class="modal-body">' + message + '</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"> Annuler </button>
				<button type="submit" class="btn btn-warning ' + action + '" idItem="' + id + '"> Valider </button>
				<a href="' + href + '" type="submit" class="btn btn-warning"> Valider </a>
			</div>
		</div>
	</div>
</div>

