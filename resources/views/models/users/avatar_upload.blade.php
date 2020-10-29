
    <div data-role="drop-zone" class="avatar-wrapper overlay">
		
		<img class="avatar shadow" data-role="preview-image" src="{{ asset($item['profile']['avatar']) }}" data-default="{{ asset($item['profile']['avatar']) }}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.user.profile.avatar')) }}"'/>
	    
	    <div class="position-absolute w-100 d-flex align-items-center justify-content-center" data-role="drop-controls">
		    	
	    	<a class="btn btn-lg btn-light fade-in ratio-square rounded-circle shadow" data-role="drop-control-upload">
		      @svg('buttons/camera-btn','icon-xs')
		    </a>

		    <a class="btn btn-lg btn-light fade-in ratio-square rounded-circle shadow disabled" data-role="drop-control-revert">
		      @svg('buttons/undo-btn','icon-xs')
		    </a>

		    <input class="d-none" data-role="file-input" name="avatar" type="file" accept="image/png, image/jpeg" />
		
		</div>
    </div>