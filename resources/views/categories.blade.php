<section id="recent-works">
    <div class="row">
         <div align="center">
             <h2>Browse by Events Categories</h2>
                     @foreach($categories as $category)
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{!! Voyager::image( $category->cat_image ) !!}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a href="/events/category/{!! $category->slug !!}">{!! $category->name !!}</a> </h3>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
         </div>
    </div>
</section>