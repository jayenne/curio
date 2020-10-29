@foreach($models as $model)

    <div data-category="" class="card masonry-item shadow" >
        
        <div class="icon inverse hoverable">@svg('heart')</div>

        <div class="masonry-content">
            
            @if( $model->profile['background'] )
                {{--<img src= "{{ $model->profile['background'] }}" class="masonry-content" alt="" />--}}
                <img src="https://picsum.photos/seed/{{$model->id}}/500/500" class="masonry-content" alt="">
            @else
                {{--<img src="https://picsum.photos/seed/{{$model->id}}/500/500" class="masonry-content" alt="">--}}
            @endif
            
        </div>
       
        <div class="content">
            <h4>{{ $model->first_name}}</h4>
            <div class="categories d-flex flex-row">
                <span>#{{ $model->last_name}}</span>
                <span>#{{ $model->last_name}}</span>
                <span>#{{ $model->last_name}}</span>
                <span>#{{ $model->last_name}}</span>
                <span>#{{ $model->last_name}}</span>
            </div>
        </div>
        
        <div class="overlay">
                            
            <div class="details d-flex justify-content-between">
                    
                    <div class="inner left d-flex justify-content-start"> 
                        
                        <div class="avatar align-self-center">
                            @if( $model->profile['avatar'])
                                <img class="avatar" src="{{ $model->profile['avatar']}}" alt="{{ $model->username }}" />
                            @else
                                @svg('placeholder-user', 'avatar icon')
                            @endif
                        </div>
                        
                        <div class="align-self-center">{{ $model->username }}</div>
                    </div>
                    
                    <div class="inner right">
                        <i class="icon">@svg('thumbtack')</i>  
                    </div>
                    
            </div>
                 
        </div>
        
    </div>

@endforeach