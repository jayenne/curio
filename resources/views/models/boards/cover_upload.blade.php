<div data-role="drop-zone" class="cover-wrapper overlay w-100" >

	<img class="cover" data-role="preview-image" src="{{ asset(config('platform.fallback.board.detail.upload')) }}"  data-default="{{ asset(config('platform.fallback.board.detail.upload')) }}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.board.detail.missing')) }}"'/>

    <div class="position-absolute d-flex justify-content-center align-items-center p-2" data-role="drop-controls">
		<div class="d-flex justify-content-center align-items-center">
	    	<a class="btn btn-lg btn-light fade-in ratio-square rounded-circle shadow m-1" data-role="drop-control-upload">
		      @svg('buttons/camera-btn','icon-xs')
		    </a>
	    
		    <a class="btn btn-lg btn-link fade-in ratio-square rounded-circle shadow m-1 disabled" data-role="drop-control-revert">
		      @svg('buttons/undo-btn','icon-xs')
		    </a>

		    <input class="d-none" data-role="file-input" name="cover" type="file" accept="image/png, image/jpeg" />
		</div>
	</div>
</div>
