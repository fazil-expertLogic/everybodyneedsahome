<!-- Sidebar -->

@if (Route::is(['property-list']))
<div class="col-xl-3 theiaStickySidebar">
    @else
    <div class="col-xl-4 theiaStickySidebar">
        @endif
        <div class="left-sidebar-widget property-sidebar">
            <!-- Advanced Search -->
            <div class="collapse-card">
                <h4 class="card-title">
                    <a class="collapsed" data-bs-toggle="collapse" href="#advance-search" aria-expanded="false">Advanced Search</a>
                </h4>
                <div id="advance-search" class="card-collapse collapse show">
                    <ul class="show-list">
                        <li class="review-form form-wrap">

                            <input type="text" class="form-control" placeholder="Type Keywords" id="keyword" name="keywords">
                            <span class="form-icon">
                                <i class="bx bx-search-alt"></i>
                            </span>
                        </li>
                        <li class="review-form">
                            <select id="state" class="select">
                                <option>Select States</option>
                                <option value="USA">USA</option>
                                <option value="Berlin">Berlin</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Flynn">Flynn</option>
                            </select>
                        </li>
                        <li class="review-form">
                            <select id="bedrooms" class="select">
                                <option>No of Bedrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </li>
                        <li class="review-form">
                            <select id="bathrooms" class="select">
                                <option>No of Bathrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /Advanced Search -->

            <!-- Apply filter -->
            <div class="apply-btn">
                <button type="button" class="btn btn-primary" id="apply-filters">Apply Filter</button>
                <a href="javascript:void(0);" class="reset-btn">Reset Selection</a>
            </div>
            <!-- /Apply filter -->

        </div>
    </div>
    <!-- /Sidebar -->

    <!-- Property List -->
     