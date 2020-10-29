<div data-role="drop-zone" class="cover-wrapper overlay w-100" >

	<img class="cover" data-role="preview-image" src="{{ asset($item['profile']['cover']) }}"  data-default="{{ asset($item['profile']['cover']) }}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.user.profile.cover')) }}"'/>

    <div class="position-absolute top w-100 d-flex justify-content-start align-self-start p-2" data-role="drop-controls">

    	<a class="btn btn-lg btn-light fade-in ratio-square rounded-circle shadow m-1" data-role="drop-control-upload">
	      @svg('buttons/camera-btn','icon-xs')
	    </a>
    
	    <a class="btn btn-lg btn-link fade-in ratio-square rounded-circle shadow m-1 disabled" data-role="drop-control-revert">
	      @svg('buttons/undo-btn','icon-xs')
	    </a>

	    <input class="d-none" data-role="file-input" name="cover" type="file" accept="image/png, image/jpeg" />

	</div>
</div>
