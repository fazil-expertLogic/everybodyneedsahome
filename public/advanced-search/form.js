$(document).ready(function () {
    var searchPropertiesUrl = "{{ route('search-properties') }}"; // Make sure this is processed as a Blade directive

    $('#apply-filters').on('click', function (event) {
        event.preventDefault(); // Prevent default form submission

        var keywords = $('#keyword').val() || '';
        var state = $('#state').val() || '';
        var bedrooms = $('#bedrooms').val() || '';
        var bathrooms = $('#bathrooms').val() || '';
        var minSqft = $('#min-sqft').val() || ''; // Add if you have a minSqft input
       

        // Prepare data to send
        var searchData = {
            keywords: keywords,
            state: state,
            bedrooms: bedrooms,
            bathrooms: bathrooms,
            minSqft: minSqft // Include this if you're using it in the backend
        };

        $.ajax({
            url: searchPropertiesUrl, // Use the defined variable
            type: 'POST', // Use POST method
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is sent
            },
            data: JSON.stringify(searchData), // Send data as JSON
            contentType: 'application/json', // Set the content type
            success: function (data) {
                updatePropertyList(data.properties); // Handle success
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching properties:', textStatus, errorThrown); // Handle error
            }
        });
    });

    // Reset functionality
    $('.reset-btn').on('click', function () {
        $('#keyword').val('');
        $('#state').prop('selectedIndex', 0);
        $('#bedrooms').prop('selectedIndex', 0);
        $('#bathrooms').prop('selectedIndex', 0);
        $('#min-sqft').val(''); // Reset minSqft if it exists
    });
});

// Function to update the property list
function updatePropertyList(properties) {
    const propertyList = $('.buy-list'); // Adjust the selector to your property list container
    propertyList.empty(); // Clear existing properties

    properties.forEach(property => {
        const propertyItem = `
            <div class="col-lg-12">
                <div class="product-custom">
                    <div class="profile-widget rent-list-view">
                        <div class="doc-img">
                            <a href="{{ url('buy-details') }}/${property.id}" class="property-img">
                                <img class="img-fluid" alt="Product image"
                                    src="${property.main_picture ? '/storage/' + property.main_picture : '/assets/img/product/product-1.jpg'}">
                            </a>
                            ${property.is_feature ? '<div class="featured"><span>Featured</span></div>' : ''}
                            ${property.is_new ? '<div class="new-featured"><span>New</span></div>' : ''}
                            <a href="javascript:void(0)">
                                <div class="favourite">
                                    <span><i class="fa-regular fa-heart"></i></span>
                                </div>
                            </a>
                            <div class="user-avatar">
                                <img src="{{ URL::asset('/assets/img/profiles/avatar-02.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="pro-content">
                            <div class="list-head">
                                <div class="rating">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <span class="me-1">5.0</span> (20 Reviews)
                                    <div class="product-name-price">
                                        <h3 class="title">
                                            <a href="{{ url('buy-details') }}/${property.id}" tabindex="-1">${property.property_name}</a>
                                        </h3>
                                        <div class="product-amount">
                                            <h5><span>$${property.bed_fee + property.bedroom_fee + property.unit_fee}</span></h5>
                                        </div>
                                    </div>
                                    <p><i class="feather-map-pin"></i> ${property.property_address}</p>
                                </div>
                            </div>
                            <ul class="d-flex details">
                                <li>
                                    <img src="{{ URL::asset('/assets/img/icons/bed-icon.svg') }}" alt="bed-icon">
                                    ${property.number_of_beds} Beds
                                </li>
                                <li>
                                    <img src="{{ URL::asset('/assets/img/icons/bath-icon.svg') }}" alt="bath-icon">
                                    ${property.number_of_bedrooms} Bath
                                </li>
                                <!-- Uncomment if needed
                                <li>
                                    <img src="{{ URL::asset('/assets/img/icons/building-icon.svg') }}" alt="building-icon">
                                    15000 Sqft
                                </li> -->
                            </ul>
                            <ul class="property-category d-flex justify-content-between">
                                <li>
                                    <span class="list">Listed on : </span>
                                    <span class="date">${new Date(property.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}</span>
                                </li>
                                <li>
                                    <span class="category list">Category : </span>
                                    <span class="category-value date">${property.category ? property.category.category_name : ''}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
        propertyList.append(propertyItem); // Append property item to the list
    });
}

