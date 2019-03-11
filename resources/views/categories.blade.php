<section id="recent-works">
    <div class="row">
         <div align="center">
             <h3><b>Browse Events by Category</b></h3>
                     @foreach($categories as $category)
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive hoverable" src="{!! Voyager::image( $category->cat_image ) !!}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><u><a href="/events/category/{!! $category->slug !!}">{!! $category->name !!}</a></u></h3>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
         </div>
    </div>
</section>